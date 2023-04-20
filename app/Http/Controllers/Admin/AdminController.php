<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
use App\Rules\IsValidPassword;
use App\Models\Testimonial;
use App\Models\SalonInfo;
use App\Models\Team;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:Admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminprofile(){
        $user_id = Auth::guard('Admin')->user()->id;
            $admin = Admin::find($user_id);
        return view('Admin.profile',compact('admin'));

    }
    public function updateProfile(Request $request){
        $user_id = Auth::guard('Admin')->user()->id;
        $admin = Admin::find($user_id);
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:admins,email,' . $user_id,
        ]);
        Admin::find($user_id)->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return redirect()->route('adminprofile')->with('success', 'Successfully update profile details');
    }
    function ResetPassword()
    {
        return view('Admin.ResetPassword');
    }
    public function UpdatePwd(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required', new IsValidPassword()],
            'confirm_password' => ['required', 'same:new_password'],
        ]);
        $user_id = Auth::guard('Admin')->user()->id;
        Admin::find($user_id)->update(['password' => Hash::make($request->new_password)]);  
        return redirect()->route('ResetPassword')->with('success', 'Successfully update profile details');
    }
    public function CreateAdminUser(){
        return view('Admin.CreateAdminUser');
    }
    public function InsertAdminUser(Request $request)  
   
    {  
    
        $request->validate([  
            'name'=>'required',  
            'email'=>'required|email',  
            'password'=>'required',   
        ]);  
  
        $crud = new Admin;  
        $crud->name =  $request->get('name');  
        $crud->email = $request->get('email');  
        $crud-> password = $request->get('password');  
        $crud-> password = Hash::make($request->password);  
        $crud->save();  
        return redirect()->route('CreateAdminUser')->with('success','successfully Insert Admin User details');
        }  
        public function ViewAdmin()  
    {  
        $cruds = Admin::all();  
  
        return view('Admin.ViewAdmin', compact('cruds'));  
    }  
    public function edit($id)  
    {  
        
     $crud= Admin::find($id);  
     return view('Admin.EditAdmin', compact('crud'));  

    }
    public function update(Request $request, $id)  
    {  
        $admin = Admin::find($id);

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:admins,email,' . $id,
        ]);
        Admin::find($id)->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return redirect()->route('EditAdmin',[$id])->with('success', 'Successfully update profile details');

    }
    public function delete($id)  
     {  
         $crud=Admin::find($id);  
         $crud->delete();  
         return redirect()->route('ViewAdmin',[$id])->with('success', 'Successfully update profile details');
 
     }



    
    public function CreateCategory(){
        return view('Admin.CreateCategory');
    }
    
    public function InsertCategory(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
  
        $input = $request->all();
  
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
    
        Category::create($input);
     
        return redirect()->route('CreateCategory')
                        ->with('success','Category created successfully.');
    }
    public function deletecategory($id)  
    {  
        $category=Category::find($id);  
        $category->delete();  
        return redirect()->route('ViewCategory')->with('success', 'category deleted successfully');

    } 

    public function ViewCategory()
    {
        $category = Category::latest()->paginate(5);
    
        return view('Admin.ViewCategory',compact('category'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function EditCategory($id)
    {
        $category= Category::find($id);  
     return view('Admin.EditCategory', compact('category'));  
    }
    public function updatecategory(Request $request, Category $category, $id)
    {
        $category= Category::find($id); 
        
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
  
        $input = $request->all();
  
        if ($request->file('image')) {
            $image = $request->file('image');
            echo "test";
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = $profileImage;
        }else{
            unset($input['image']);
        }
          dd($input);
        $category->update($input);
    
        return redirect()->route('EditCategory',[$id])->with('success', 'Successfully update profile details');

    }  



    public function CreateTestimonial(){
        return view('Admin.CreateTestimonial');
    }
    public function InsertTestimonial(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'comments' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'rating' => 'required',
        ]);
  
        $input = $request->all();
  
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";

        }
    
        Testimonial::create($input);
     
        return redirect()->route('CreateTestimonial')
                        ->with('success','Testimonial created successfully.');
    }
    public function ViewTestimonial()
  {
      $testimonial = Testimonial::latest()->paginate(5);
  
      return view('Admin.ViewTestimonial',compact('testimonial'))
          ->with('i', (request()->input('page', 1) - 1) * 5);
  }
  public function EditTestimonial($id)
  {
    $testimonial=Testimonial::find($id);
    return view('Admin.EditTestimonial',compact('testimonial'));
    
    }
    public function deletetestimonial($id)
  {
      $testimonial=Testimonial::find($id);  
      $testimonial->delete();  
   
      return redirect()->route('ViewTestimonial')
                      ->with('success','Testimonial deleted successfully');
  }
  public function updatetestimonial(Request $request,Testimonial $testimonial, $id)
  {
      $testimonial= Testimonial::find($id); 
      $request->validate([
          'name' => 'required',
          'position' => 'required',
          'comments' => 'required',
          'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      ]);

      $input = $request->all();

      if ($request->file('image')) {
          $image = $request->file('image');
          echo "test";
          $destinationPath = 'image/';
          $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
          $image->move($destinationPath, $profileImage);
          $input['image'] = $profileImage;
      }else{
          unset($input['image']);
      }
        //dd($input);
      $testimonial->update($input);
  
      return redirect()->route('EditTestimonial',[$id])->with('success', 'Successfully update profile details');

  }




  public function SalonInfo(){
    return view('Admin.SalonInfo');
}
public function InsertSalonInfo(Request $request)
    {
        $request->validate([
            'aboutsalon' => 'required',
             
        ]);
  
        $input = $request->all();
   
        
    
        SalonInfo::create($input);
     
        return redirect()->route('SalonInfo')
                        ->with('success','Salon information created successfully.');
    }



    public function CreateTeam(){
        return view('Admin.CreateTeam');
    }
    public function InsertTeam(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         ]);
  
        $input = $request->all();
  
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";

        }
    
        Team::create($input);
     
        return redirect()->route('CreateTeam')
                        ->with('success','Team Member details created successfully.');
         
    }
    public function deleteteam($id)
    {
        $team=Team::find($id);  
        $team->delete();  
     
        return redirect()->route('ViewTeam')
                        ->with('success',' deleted successfully');
    }
    public function ViewTeam()
    {
        $team = Team::latest()->paginate(5);
    
        return view('Admin.ViewTeam',compact('team'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function EditTeam($id)
    {
        $team= Team::find($id);  
     return view('Admin.EditTeam', compact('team'));  
    }
    public function updateteam(Request $request, Category $category, $id)
    {
        $team= Team::find($id); 
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
  
        $input = $request->all();
  
        if ($request->file('image')) {
            $image = $request->file('image');
            echo "test";
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = $profileImage;
        }else{
            unset($input['image']);
        }
          //dd($input);
        $team->update($input);
    
        return redirect()->route('EditTeam',[$id])->with('success', 'Successfully update profile details');

    }  
}