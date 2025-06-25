<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Category;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Mcq;
use App\Models\Record;
use App\Models\MCQ_Record;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    function welcome()
    {
        // $category=Category::get();

        $categories = Category::withCount('quizzes')->get();
        return view('welcome', ['data' => $categories]);
    }

    function userQuizList($id, $category)
    {
        $quizData = Quiz::withCount('Mcq')
            ->where('category_id', $id)
            ->get();
        return view('user-quiz-list', ['quizdata' => $quizData, 'category' => $category]);
    }

    function userRegister(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:4|max:30',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:4|max:30|confirmed',
        ]);

        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);

        if ($user->save()) {
            Session::put('userDetails', $user);
            if (Session::has('quiz-url')) {
                $url = Session::get('quiz-url');
                Session::forget('quiz-url');
                return redirect("$url")->with('success', 'Signed IN Successfully');
            } else {
                return redirect('user-login')->with('success', 'Signed IN Successfully');
            }
        }
    }

    function userLogin(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            return redirect()
                ->back()
                ->with('email', 'User Not Found');
        }

        if (!Hash::check($validated['password'], $user->password)) {
            return redirect()
                ->back()
                ->with('password', 'Incorrect Password');
        }

        if ($user->save()) {
            Session::put('userDetails', $user);
            if (Session::has('quiz-url')) {
                $url = Session::get('quiz-url');
                Session::forget('quiz-url');
                return redirect("$url")->with('success', 'Signed IN Successfully');
            } else {
                return redirect('/')->with('success', 'Signed IN Successfully');
            }
        }
    }

    function startQuiz($id, $category)
    {
        $quizCount = Mcq::where('quiz_id', $id)->count();
        $quizdata = Mcq::where('quiz_id', $id)->get();

        Session::put('firstmcq', $quizdata[0]);
        $quizName = $category;

        return view('start-quiz', ['quizname' => $quizName, 'count' => $quizCount]);
    }

    function logoutUser()
    {
        Session::forget('userDetails');
        return redirect('/');
    }

    function userRegisterStartQuiz()
    {
        Session::put('quiz-url', url()->previous());
        return view('user-signup');
    }

    function userLoginStartQuiz()
    {
        Session::put('quiz-url', url()->previous());
        return view('user-login');
    }

    function mcq($id, $name)
    {

        $record = new Record();
        $record->user_id = Session::get('userDetails')->id;
        $record->quiz_id = Session::get('firstmcq')->quiz_id;
        $record->status = 1;


        if ($record->save()) {
            // return MCQ::where('quiz_id', Session::get('firstmcq')->quiz_id)->get();

            $currentQuiz = [];
            $currentQuiz['totalMcq'] = MCQ::where('quiz_id', Session::get('firstmcq')->quiz_id)->count();

            $currentQuiz['currentMcq'] = 1;
            $currentQuiz['quizName'] = $name;
            $currentQuiz['quizId'] = Session::get('firstmcq')->quiz_id;

            $currentQuiz['recordId'] = $record->id;
            Session::put('currentQuiz', $currentQuiz);

            $mcqData = MCQ::find($id);

            return view('mcq-page', ['quizName' => $name, 'mcqData' => $mcqData]);
        } else {
            echo  "something went wrong";
        }
    }



    public function submitAndNext(Request $request, $id)
    {
        // 🔹 Step 1: Retrieve current quiz data from session
        $currentQuiz = Session::get('currentQuiz');

        // 🔹 Step 2: Move to the next question
        $currentQuiz['currentMcq'] += 1;

        // 🔹 Step 3: Save updated progress back to session
        Session::put('currentQuiz', $currentQuiz);

        // 🔹 Step 4: Fetch the next MCQ from database
        $mcqData = MCQ::where([
            ['id', '>', $id],
            ['quiz_id', '=', $currentQuiz['quizId']],
        ])->first(); // Get the next question only

        // 🔹 Step 5: Check if an answer for this question already exists in the database
        $isExist = MCQ_Record::where([
            ['record_id', '=', $currentQuiz['recordId']],
            ['mcq_id', '=', $request->id],
        ])->count();

        // 🔹 Step 6: If answer does not exist, create a new record
        if ($isExist < 1) {
            $mcq_record = new MCQ_Record();

            $mcq_record->record_id      = $currentQuiz['recordId'];
            $mcq_record->user_id        = Session::get('userDetails')->id;
            $mcq_record->mcq_id         = $request->id;
            $mcq_record->select_answer  = $request->option;

            // 🔹 Step 7: Check if the selected answer is correct
            $correctAnswer = MCQ::find($request->id)->correct_ans;

            $mcq_record->is_correct = ($request->option === $correctAnswer) ? 1 : 0;

            // 🔹 Step 8: Save the record to the database
            if (!$mcq_record->save()) {
                return "Something went wrong while saving your answer.";
            }
        }

        // 🔹 Step 9: If there's a next MCQ, show the MCQ page
        if ($mcqData) {
            return view('mcq-page', [
                'quizName' => $currentQuiz['quizName'],
                'mcqData'  => $mcqData,
            ]);
        } else {
            // 🔹 Step 10: No more questions — go to the result page



            $resultData = MCQ_Record::WithMCQ()->where('record_id', $currentQuiz['recordId'])->get();

            $correctAns = MCQ_Record::where([
                ['record_id', '=', $currentQuiz['recordId']],
                ['is_correct', '=', 1],
            ])->count();
            $record = Record::find($currentQuiz['recordId']);

            if ($record) {
                $record->status = 2;
                $record->update();
            }
            return view('quiz-result', ['resultData' => $resultData, 'correctAns' =>
            $correctAns]); // Replace with a redirect or view later
        }
    }

    function usersDetails()
    {

        $userId = Session::get('userDetails')->id;

        // Get the actual records from the database
        $quizRecord = Record::WithQuiz()->where('user_id', $userId)->get();


        return view('user-details', ['quizRecord' => $quizRecord]);
    }
}
