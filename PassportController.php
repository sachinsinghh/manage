<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use DB;
use Illuminate\Notifications\Notifiable;
use App\Notifications\MailNotification;

class PassportController extends Controller
{
     public $successStatus = 200;
     use Notifiable;


/***************User Login********************/
    public function login(Request $request)
    {
    	$credentials = $request->only('email', 'password');
    	if (Auth::attempt($credentials)) {
            $user=Auth::user();
            $success['token']=$user->createToken('MyApp')->accessToken;
            return response()->json(['success'=>$success],$this->successStatus);
    	} 
    	else
    	{
    		return response()->json(['error'=>'Unauthorized',401]);
    	}
    }



/*********Register User****************/

    public function register(Request $request)
    {

    	
    	$validator=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'c_password'=>'required|same:password'
    		]);
    	if($validator->fails())
    	{
    		return response()->json(['error'=>$validator->errors()],401);
    	}
    	$input= $request->all();

    	$input['password']=bcrypt($input['password']);
    	$user=User::create($input);

/***Define user role in Role table*****/
    	 $role = new Role;
        $role->user_id = $user->id;
        $role->role_type = 'user';
        $role->save();
/*********************************End***********************************/

    	$sucess['token']=$user->createToken('MyApps')->accessToken;
    	
    	$sucess['name']=$user->name;

   /*************Send verification notification to user************/     
        $user->notify(new MailNotification);
      /************End***********************/  
    	return response()->json(['success'=>$sucess],$this->successStatus);
    }
    /***********Register User ends here***************/





/*******************Admin can see users and their attendances in a single table view**************/
    public function getDetails()
    {
        //Authorization check 
         if (Auth::check()) {
    if(Auth::user()->id==1)
   {
        $user= Auth::user();
    $user=DB::table('posts')->orderBy('date','ASC')->get();
    return response()->json(['success'=>$user],$this->successStatus);
   }
   else
   {
     return response()->json(['Failed'=>'Not authorized'],403);
   }
}

else{
   return response()->json(['Failed'=>'Not authorized'],403); 
}   
    }


/*****************************Admin can filter results through date range****************/
    public function filterDate()
    {
         if (Auth::check()) {

     if(Auth::user()->id==1)
   {
        $user= Auth::user();
    $user=DB::table('posts')->whereBetween('date', ['02-11-2018', '02-11-2018'])->get();
    return response()->json(['success'=>$user],$this->successStatus);
   }
    else
   {
     return response()->json(['Failed'=>'Not authorized'],403);
   }

}
else{
   return response()->json(['Failed'=>'Not authorized'],403); 
}   
  
    }


    public function logout()
    {
       if (Auth::check()) {
       Auth::user()->token()->revoke();
       return response()->json(['success'=>'Logged Out successfully'],$this->successStatus);
    }
    }

/*******************User can mark attendence through a button feature****************/
    public function submitAttendence()
    {
 if (Auth::check()) 
 {
    $user= Auth::user();
   	$time = date("h:i A");
   	$date =date("d-m-Y");
     DB::table('posts')->insert(
    ['name' => $user->name, 'date' => $date,'time' =>  $time]
);
   return response()->json(['success'=>'Submitted successfully'],$this->successStatus);
}
else{
   return response()->json(['Failed'=>'Not authorized'],403); 
}   
      }

}
