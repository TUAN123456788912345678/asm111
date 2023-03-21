<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Categories;
use App\Models\Courses;
use App\Models\Topics;
use App\Models\AssignCourses;
use App\Models\AssignTopics;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class StaffController extends Controller
{

    public function Staffindex(){
        return view('Staff.Page.indexStaff');
    }

    public function Traineeindex(){
        $trainee = DB::table('human_resources')
        ->join('roles', 'human_resources.role_id', '=', 'roles.id')
        ->where('roles.name', '=', 'Trainee')
        ->select('human_resources.*')
        ->get();
        return view('Staff.Page.Trainee.listTrainee', compact('trainee'));
    }

    public function getAddTrainee(){
        return view('Staff.Page.Trainee.addTrainee');
    }

    public function postAddTrainee(Request $request){
        if($request->isMethod('POST')){
            $validator=Validator::make($request->all(),[
                'username'=>'required|unique:human_resources,username',
                'password'=>'required',
                'name'=>'required',
                'age'=>'required',
                'DoB'=>'required',
                'address'=>'required',
                'education'=>'required',
                'department'=>'required',
                'education'=>'required',
                'main_programming_language'=>'required',
                'toeic_score'=>'required',
            ]);

            if($validator->fails()){
                return redirect()->back()
                ->withErrors($validator)
                ->withInput();
            }

            $trainee= new User;
            $trainee->username=$request->username;
            $trainee->password=Hash::make($request->password);
            $trainee->name=$request->name;
            $trainee->age=$request->age;
            $trainee->DoB=$request->DoB;
            $trainee->address=$request->address;
            $trainee->education=$request->education;
            $trainee->department=$request->department;
            $trainee->main_programming_language=$request->main_programming_language;
            $trainee->toeic_score=$request->toeic_score;
            $trainee->role_id='4';
            $trainee->save();
            return redirect()->route('staff.trainee.index')->with('success','Add new Trainee Account Successfully!');
        }
    }

    public function getUpdateTrainee($id){
        $data['trainee']=User::find($id);
        return view('Staff.Page.Trainee.updateTrainee', $data);
    }

    public function postUpdateTrainee(Request $request, $id){
        if($request->isMethod('POST')){
            $validator=Validator::make($request->all(),[
                
            ]);

            if($validator->fails()){
                return redirect()->back()
                ->withErrors($validator)
                ->withInput();
            }

            $trainee= User::find($id);
            $trainee->username=$request->username;
            $trainee->password=Hash::make($request->password);
            $trainee->name=$request->name;
            $trainee->age=$request->age;
            $trainee->DoB=$request->DoB;
            $trainee->address=$request->address;
            $trainee->education=$request->education;
            $trainee->department=$request->department;
            $trainee->main_programming_language=$request->main_programming_language;
            $trainee->toeic_score=$request->toeic_score;
            $trainee->save();
            return redirect()->route('staff.trainee.index')->with('success','Update Trainee Account Successfully!');
        }
    }

    public function deleteTrainee($id){
        $trainee=User::find($id);
        $trainee->delete();
        return back()->with('success', 'Delete Trainee Successfully!');
    }

    public function searchTrainee(Request $request){
        $search=$request->input('search');
        $trainee=User::query()->where('username','LIKE','%'.$search.'%')
        ->orwhere('main_programming_language','LIKE','%'.$search.'%')
        ->orwhere('toeic_score','LIKE','%'.$search.'%')
        ->get();
        return view('Staff.Page.Trainee.searchTrainee', compact('trainee'), compact('search'));
    }

    public function Categoryindex(){
        $category=Categories::all();
        return view('Staff.Page.Category.listCategory', compact('category'));
    }

    public function getAddCategory(){
        return view('Staff.Page.Category.addCategory');
    }

    public function postAddCategory(Request $request){
        if($request->isMethod('POST')){
            $validator=Validator::make($request->all(),[
                'name'=>'required|unique:categories,name',
                'description'=>'required',
            ]);

            if($validator->fails()){
                return redirect()->back()
                ->withErrors($validator)
                ->withInput();
            }

            $category= new Categories;
            $category->name=$request->name;
            $category->description=$request->description;
            $category->save();
            return redirect()->route('staff.category.index')->with('success','Add new Category Successfully!');
        }
    }

    public function getUpdateCategory($id){
        $data['category']=Categories::find($id);
        return view('Staff.Page.Category.updateCategory', $data);
    }

    public function postUpdateCategory(Request $request, $id){
        if($request->isMethod('POST')){
            $validator=Validator::make($request->all(),[
                
            ]);

            if($validator->fails()){
                return redirect()->back()
                ->withErrors($validator)
                ->withInput();
            }

            $category= Categories::find($id);
            $category->name=$request->name;
            $category->description=$request->description;
            $category->save();
            return redirect()->route('staff.category.index')->with('success','Update Category Successfully!');
        }
    }

    public function deleteCategory($id) {
        $coursesCount = Courses::where('category_id', $id)->count();
        if ($coursesCount > 0) {
            return redirect()->back()->with('error', 'Some Courses is associated with this Category so this Category cannot be deleted!');
        }
        
        Categories::where('id', $id)->delete();
        return redirect()->route('staff.category.index')->with('success', 'Delete Category Successfully!');
    }

    public function searchCategory(Request $request){
        $search=$request->input('search');
        $category=Categories::query()->where('name','LIKE','%'.$search.'%')
        ->get();
        return view('Staff.Page.Category.searchCategory', compact('category'), compact('search'));
    }

    public function Courseindex(){
        $course=Courses::all();
        $category=Categories::all();
        return view('Staff.Page.Course.listCourse', compact('course', 'category'));
    }

    public function getAddCourse(){
        $category=Categories::all();
        return view('Staff.Page.Course.addCourse', compact('category'));
    }

    public function postAddCourse(Request $request){
        if($request->isMethod('POST')){
            $validator=Validator::make($request->all(),[
                'name'=>'required|unique:courses,name',
                'description'=>'required',
                'category_id'=>'required',
            ]);

            if($validator->fails()){
                return redirect()->back()
                ->withErrors($validator)
                ->withInput();
            }

            $course= new Courses;
            $course->name=$request->name;
            $course->description=$request->description;
            $course->category_id=$request->category_id;
            $course->save();
            return redirect()->route('staff.course.index')->with('success','Add new Course Successfully!');
        }
    }

    public function getUpdateCourse($id){
        $data['course']=Courses::find($id);
        $category=Categories::all();
        return view('Staff.Page.Course.updateCourse', $data, compact('category'));
    }

    public function postUpdateCourse(Request $request, $id){
        if($request->isMethod('POST')){
            $validator=Validator::make($request->all(),[
                
            ]);

            if($validator->fails()){
                return redirect()->back()
                ->withErrors($validator)
                ->withInput();
            }

            $course= Courses::find($id);
            $course->name=$request->name;
            $course->description=$request->description;
            $course->category_id=$request->category_id;
            $course->save();
            return redirect()->route('staff.course.index')->with('success','Update Course Successfully!');
        }
    }

    public function deleteCourse($id) {
        $topicsCount = Topics::where('course_id', $id)->count();
        $assignsCount = AssignCourses::where('course_id', $id)->count();
        if ($topicsCount > 0 || $assignsCount > 0) {
            return redirect()->back()->with('error', 'Some Topics is associated with this Course 
            or a Trainer was assigned to this Course. So this Course cannot be deleted!');
        }
        
        Courses::where('id', $id)->delete();
        return redirect()->route('staff.course.index')->with('success', 'Delete Course Successfully!');
    }

    public function searchCourse(Request $request){
        $search=$request->input('search');
        $course=Courses::query()->where('name','LIKE','%'.$search.'%')
        ->get();
        return view('Staff.Page.Course.searchCourse', compact('course', 'search'));
    }

    public function Topicindex(){
        $topic=Topics::all();
        $course=Courses::all();
        return view('Staff.Page.Topic.listTopic', compact('topic', 'course'));
    }

    public function getAddTopic(){
        $course=Courses::all();
        return view('Staff.Page.Topic.addTopic', compact('course'));
    }

    public function postAddTopic(Request $request){
        if($request->isMethod('POST')){
            $validator=Validator::make($request->all(),[
                'name'=>'required|unique:topics,name',
                'description'=>'required',
                'course_id'=>'required',
            ]);

            if($validator->fails()){
                return redirect()->back()
                ->withErrors($validator)
                ->withInput();
            }

            $topic= new Topics;
            $topic->name=$request->name;
            $topic->description=$request->description;
            $topic->course_id=$request->course_id;
            $topic->save();
            return redirect()->route('staff.topic.index')->with('success','Add new Topic Successfully!');
        }
    }

    public function getUpdateTopic($id){
        $data['topic']=Topics::find($id);
        $course=Courses::all();
        return view('Staff.Page.Topic.updateTopic', $data, compact('course'));
    }

    public function postUpdateTopic(Request $request, $id){
        if($request->isMethod('POST')){
            $validator=Validator::make($request->all(),[
                
            ]);

            if($validator->fails()){
                return redirect()->back()
                ->withErrors($validator)
                ->withInput();
            }

            $topic= Topics::find($id);
            $topic->name=$request->name;
            $topic->description=$request->description;
            $topic->course_id=$request->course_id;
            $topic->save();
            return redirect()->route('staff.topic.index')->with('success','Update Topic Successfully!');
        }
    }

    public function deleteTopic($id) {
        $topicsCount = Topics::where('course_id', $id)->count();
        if ($topicsCount > 0) {
            return redirect()->back()->with('error', 'Some Topics is associated with this Course 
            or a trainer was assigned to this course. So this Course cannot be deleted!');
        }
        
        Topics::where('id', $id)->delete();
        return redirect()->route('staff.topic.index')->with('success', 'Delete Topics Successfully!');
    }

    public function Trainerindex(){
        $trainer = DB::table('human_resources')
        ->join('roles', 'human_resources.role_id', '=', 'roles.id')
        ->where('roles.name', '=', 'Trainer')
        ->select('human_resources.*')
        ->get();
        return view('Staff.Page.Trainer.listTrainer', compact('trainer'));
    }

    public function getAddTrainer(){
        return view('Staff.Page.Trainer.addTrainer');
    }

    public function postAddTrainer(Request $request){
        if($request->isMethod('POST')){
            $validator=Validator::make($request->all(),[
                'username'=>'required|unique:human_resources,username',
                'password'=>'required',
                'name'=>'required',
                'department'=>'required',
                'phone'=>'required',
                'email'=>'required|email|unique:human_resources,email',
            ]);

            if($validator->fails()){
                return redirect()->back()
                ->withErrors($validator)
                ->withInput();
            }

            $trainer= new User;
            $trainer->username=$request->username;
            $trainer->password=Hash::make($request->password);
            $trainer->name=$request->name;
            $trainer->type=$request->type;
            $trainer->department=$request->department;
            $trainer->phone=$request->phone;
            $trainer->email=$request->email;
            $trainer->role_id='3';
            $trainer->save();
            return redirect()->route('staff.trainer.index')->with('success','Add new Trainer Account Successfully!');
        }
    }

    public function getUpdateTrainer($id){
        $data['trainer']=User::find($id);
        return view('Staff.Page.Trainer.updateTrainer', $data);
    }

    public function postUpdateTrainer(Request $request, $id){
        if($request->isMethod('POST')){
            $validator=Validator::make($request->all(),[
                'username'=>'unique:human_resources,username',

            ]);

            if($validator->fails()){
                return redirect()->back()
                ->withErrors($validator)
                ->withInput();
            }

            $trainer= User::find($id);
            $trainer->username=$request->username;
            $trainer->password=Hash::make($request->password);
            $trainer->name=$request->name;
            $trainer->type=$request->type;
            $trainer->department=$request->department;
            $trainer->phone=$request->phone;
            $trainer->email=$request->email;
            $trainer->role_id='2';
            $trainer->save();
            return redirect()->route('staff.trainer.index')->with('success','Update Trainer Account Successfully!');
        }
    }

    public function deleteTrainer($id){
        $trainer=User::find($id);
        $trainer->delete();
        return back()->with('success', 'Delete Trainer Successfully!');;
    }

    public function AssignCourseindex(){
        $courseTrainers = DB::table('assigned_courses')
        ->join('human_resources', 'assigned_courses.trainee_id', '=', 'human_resources.id')
        ->join('courses', 'assigned_courses.course_id', '=', 'courses.id')
        ->select(
            'assigned_courses.id', 
            'assigned_courses.trainee_id', 
            'human_resources.name as trainee_name', 
            'assigned_courses.course_id', 
            'courses.name as course_name',
            'courses.description'
        )
        ->get();
        return view('Staff.Page.CourseAssign.listCourseAssign', compact('courseTrainers'));
    }

    public function getAddAssignCourse(){
        $trainee = DB::table('human_resources')
        ->join('roles', 'human_resources.role_id', '=', 'roles.id')
        ->where('roles.name', '=', 'Trainee')
        ->select('human_resources.*')
        ->get();
        $course = Courses::all();
        return view('Staff.Page.CourseAssign.addCourseAssign', compact('trainee', 'course'));
    }

    public function postAddAssignCourse(Request $request){
        if($request->isMethod('POST')){
            $validator=Validator::make($request->all(),[

            ]);

            if($validator->fails()){
                return redirect()->back()
                ->withErrors($validator)
                ->withInput();
            }

            AssignCourses::create([
                'trainee_id' => $request->input('trainee_id'),
                'course_id' => $request->input('course_id'),
            ]);
            return redirect()->route('staff.assigncourse.index')->with('success','Assign Course Successfully!');
        }
    }

    public function getUpdateAssignCourse($id){
        $trainee = DB::table('human_resources')
        ->join('roles', 'human_resources.role_id', '=', 'roles.id')
        ->where('roles.name', '=', 'Trainee')
        ->select('human_resources.*')
        ->get();
        $course = Courses::all();
        return view('Staff.Page.CourseAssign.updateCourseAssign', compact('trainee', 'course'));
    }

    public function postUpdateAssignCourse(Request $request, $id){
        if($request->isMethod('POST')){
            $validator=Validator::make($request->all(),[

            ]);

            if($validator->fails()){
                return redirect()->back()
                ->withErrors($validator)
                ->withInput();
            }

            $assign= AssignCourses::find($id);
            $assign->trainee_id = $request->trainee_id;
            $assign->course_id = $request->course_id;
            $assign->save();
            return redirect()->route('staff.assigncourse.index')->with('success','Update Assigned Course Successfully!');
        }
    }

    public function deleteAssignCourse($id){
        $assign=AssignCourses::find($id);
        $assign->delete();
        return back()->with('success', 'Delete Assigned Course Successfully!');
    }

    public function AssignTopicindex(){
        $courseTopics = DB::table('assigned_topics')
        ->join('human_resources', 'assigned_topics.trainer_id', '=', 'human_resources.id')
        ->join('topics', 'assigned_topics.topic_id', '=', 'topics.id')
        ->select(
            'assigned_topics.id', 
            'assigned_topics.trainer_id', 
            'human_resources.name as trainer_name', 
            'assigned_topics.topic_id', 
            'topics.name as topic_name',
            'topics.description'
        )
        ->get();
        return view('Staff.Page.TopicAssign.listTopicAssign', compact('courseTopics'));
    }

    public function getAddAssignTopic(){
        $trainer = DB::table('human_resources')
        ->join('roles', 'human_resources.role_id', '=', 'roles.id')
        ->where('roles.name', '=', 'Trainer')
        ->select('human_resources.*')
        ->get();
        $topic = Topics::all();
        return view('Staff.Page.TopicAssign.addTopicAssign', compact('trainer', 'topic'));
    }

    public function postAddAssignTopic(Request $request){
        if($request->isMethod('POST')){
            $validator=Validator::make($request->all(),[

            ]);

            if($validator->fails()){
                return redirect()->back()
                ->withErrors($validator)
                ->withInput();
            }

            AssignTopics::create([
                'trainer_id' => $request->input('trainer_id'),
                'topic_id' => $request->input('topic_id'),
            ]);
            return redirect()->route('staff.assigntopic.index')->with('success','Assign Topic Successfully!');
        }
    }

    public function getUpdateAssignTopic($id){
        $trainer = DB::table('human_resources')
        ->join('roles', 'human_resources.role_id', '=', 'roles.id')
        ->where('roles.name', '=', 'Trainer')
        ->select('human_resources.*')
        ->get();
        $topic = Topics::all();
        return view('Staff.Page.TopicAssign.updateTopicAssign', compact('trainer', 'topic'));
    }

    public function postUpdateAssignTopic(Request $request, $id){
        if($request->isMethod('POST')){
            $validator=Validator::make($request->all(),[

            ]);

            if($validator->fails()){
                return redirect()->back()
                ->withErrors($validator)
                ->withInput();
            }

            $assign= AssignTopics::find($id);
            $assign->trainer_id = $request->trainer_id;
            $assign->topic_id = $request->topic_id;
            $assign->save();
            return redirect()->route('staff.assigntopic.index')->with('success','Update Assigned Topic Successfully!');
        }
    }

    public function deleteAssignTopic($id){
        $assign=AssignTopics::find($id);
        $assign->delete();
        return back()->with('success', 'Delete Assigned Topic Successfully!');
    }

}
