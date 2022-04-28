<?php

namespace Database\Seeders;


use App\Models\Answer;
use App\Models\Comment;
use App\Models\Question;
use App\Models\Tag;
use Database\Factories\Creators\StaticAnswerCreator;
use Database\Factories\Creators\StaticCommentCreator;
use Database\Factories\Creators\StaticQuestionCreator;
use Database\Factories\Creators\StaticUserCreator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $questionCreator = new StaticQuestionCreator(Question::class);
        $answerCreator = new StaticAnswerCreator(Answer::class);
        $commentCreator = new StaticCommentCreator(Comment::class);

        // create random users
//      \App\Models\User::factory(10)->create();

        // create static users
        $users = StaticUserCreator::create();
        // create tags
        $tags = Tag::factory(50)->create();


        // create questions


        $questions = $questionCreator->createForOneOwner($users[0], 100,'user_id', 'id')
        ->merge($questionCreator->createForManyOwnersRandomly($users,  100,'user_id', 'id'));


        Question::all()->each(function ($question) use ($tags) {
            $question->tags()->attach(
                $tags->random(rand(1, 5))->pluck('id')->toArray()
            );
        });


        // create comment and add questionId, userId for One
        $answers = $answerCreator->createForOneOwnerAndManyChild([$questions[0], $users[0]],10, [ ['question_id', 'id'],  ['user_id', 'id'] ]);

        $comments = $commentCreator->createForOneOwner($answers[0],10, 'answer_id', 'id');
        // create answers and add questionId, userId
        $answers = $answerCreator->createForManyOwnersRandomlyAndManyChild([ $questions, $users],1000, [ ['question_id', 'id'],  ['user_id', 'id'] ]);
        // create comment and add answerId, userId

        $comments = $commentCreator->createForManyOwnersRandomlyAndManyChild([ $users, $answers ],100, [ ['user_id', 'id'],  ['answer_id', 'id'] ]);




    }



}
