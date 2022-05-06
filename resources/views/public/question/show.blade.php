
@extends('layouts.public')

@section('content')

    <div class="q">
        <h1 class="q-title">{{$question->title}}</h1>
        <div class="q-meta">
            <div class="q-name">
                User: <a href="user/{{$question->user->id}}"> {{$question->user->name}} </a>
            </div>
            <div class="q-date">{{$question->created_at}}</div>
            @auth
                @if(Auth::user()->id == $question->user->id)
                    <div class="right-question-action d-flex">
                        <a class="btn btn-warning" style="margin-right: 10px;" href="./{{$question->id}}/edit">Edit</a>
                        <form action="/questions/{{$question->id}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                @endif
            @endauth
        </div>
        <hr>
        <div class="q-body">
            <div class="text-block">
                {!! $question->text !!}
            </div>
            <div class="rate-block">
                <div>
                    <span>Like: <span class="num">{{ $question->likeCount }}</span></span>
                    <button data-rate-type="like" data-rate-target="questions" data-target-id="{{$question->id}}" class="rate-btn">+</button>
                </div>
                <div>
                    <button data-rate-type="dislike" data-rate-target="questions" data-target-id="{{$question->id}}" class="rate-btn">-</button>
                    <span>Dislike: <span class="num">{{ $question->dislikeCount }}</span></span>
                </div>
            </div>
        </div>
        <hr style="margin-bottom: 100px;">

        <p><h2 class="text-center">Answers</h2></p>
        <ul class="answers">
            @foreach($question->answers as $answer)
                @include('.partial_view.question.answer')
            @endforeach
        </ul>
    </div>

    <div style="width: 1000px; margin: 0 auto;">
        <p>Your Answer</p>

        <form id="postForm" action="/questions/{{$question->id}}/answer" method="post">
            @csrf
            @include('.partial_view.ckeditor.ckeditor')
            <button type="submit" class="mt-3 btn btn-primary">Post Your Answer</button>
        </form>
        <script>

            const insertQuestionRateToHtml = (payload, rateType, target) => {
                let spanNum = undefined;
                if(rateType == 'like')
                    spanNum = target.previousElementSibling.querySelector('.num');
                else
                    spanNum = target.nextElementSibling.querySelector('.num');
                spanNum.innerText = parseInt(spanNum.innerText) + 1;
            }
            const insertAnswerRateToHtml = (payload, target) => {
                const spanNum = target.nextElementSibling.querySelector('.num');
                console.log(spanNum)
                spanNum.innerText = parseInt(spanNum.innerText) + 1;
            }

            async function rateQuery(e) {
                const rateType = e.target.dataset.rateType;
                const rateTarget = e.target.dataset.rateTarget;
                const targetId = e.target.dataset.targetId;

                const baseUrl = "{{ url('/') }}";
                const body = JSON.stringify({
                    rateTarget,
                    rateType,
                });

                try {
                    const data = await fetch(`${baseUrl}/rate/${targetId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'x-csrf-token': '{{csrf_token()}}',
                        },
                        body
                    })
                    const json = await data.json();
                    const rate = json.rate;
                    if(rateTarget == 'questions')
                        insertQuestionRateToHtml(rate, rateType, e.target);
                    else if(rateTarget == 'answers') {
                        insertAnswerRateToHtml(rate, e.target);
                    }
                }
                catch (e) {
                    console.log(e)
                }
            }

            document.querySelectorAll('.rate-btn').forEach((e) => {
                e.addEventListener('click', rateQuery);
            });

            const markAnswerAsUseful =  async (e) => {
                try {
                    const answerId = e.target.dataset.targetId;
                    const data = await fetch(`{{ url('/') }}`+ `/answers/${answerId}/useful`, {
                        headers: {
                            'x-csrf-token': '{{csrf_token()}}',
                        },
                        method: 'POST',
                    })
                    const response = await data.json();
                    const status = await data.status;

                    if (status === 201) {
                        e.target.classList.add('useful');
                        e.target.disable = true;
                    }
                }
                catch (e) {
                    console.error(e);
                }
            }

            document.querySelectorAll('.useful-btn').forEach((e) => {
                e.addEventListener('click', markAnswerAsUseful);
            });


            window.addEventListener('load', () => {
                const postQForm = document.querySelector('#postForm');
                postQForm.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    try {
                        const formData = new FormData(e.target);
                        console.log(formData);
                        const data = await fetch('{{url("questions/$question->id/answer")}}', {
                            headers: {
                                'x-csrf-token': '{{csrf_token()}}',
                            },
                            body: formData,
                            method: 'POST',
                        })
                        const response = await data.json();
                        const status = await data.status;
                        if(status === 201)
                        {
                            console.log(response.msg, status);
                            const example = document.querySelector('.answer-example > .answer');
                            const elemTemplate = example.cloneNode(true);
                            elemTemplate.querySelector('.answer-text').innerHTML = response.answer.text;
                            const authorLink = elemTemplate.querySelector('.author').querySelector('a');
                            authorLink.setAttribute('href', `/user/${response.answer.user.id}`);
                            authorLink.innerText = `User: ${response.answer.user.name}`;

                            const commentForm = elemTemplate.querySelector('.postCommentForm');
                            commentForm.setAttribute('action', `/questions/${response.answer.id}/comment`);
                            commentForm.addEventListener('submit', addCommentAjax);
                            commentForm.querySelector('#answerId').value = response.answer.id;

                            elemTemplate.querySelector('.add-comment-btn').addEventListener('click', showCommentForm);

                            const container = document.querySelector('.answers');
                            container.append(elemTemplate);
                            console.log(elemTemplate, elemTemplate.querySelector('.answer-text').value)
                        }
                    }
                    catch (ex) {
                        console.error(ex);
                    }
                })

            });

            async function addCommentAjax (e) {
                e.preventDefault();
                try {
                    const questionId = '{{$question->id}}';
                    const answerId = e.target.querySelector('#answerId').value;
                    const baseUlr = '{{ url('/') }}';
                    const url = baseUlr + `/questions/${questionId}/answers/${answerId}/comments`;

                    console.log(url);
                    const data = await fetch(url, {
                        headers: {
                            'x-csrf-token': '{{csrf_token()}}',
                        },
                        body: new FormData(e.target),
                        method: 'POST',
                    });

                    const response = await data.json();
                    const status = await data.status;
                    if(status === 201)
                    {
                        console.log(response.msg, status);
                        const li = document.createElement('li');
                        const a = document.createElement('a');
                        li.innerText = response.comment.text + ' - ';
                        a.setAttribute('href', `/questions/{{$question->id}}/answers/${response.comment.answer.id}/comments`);
                        a.innerText = response.comment.user.name;
                        li.append(a);
                        const ul = e.target.closest('.comment-form').nextElementSibling.querySelector('.comments');
                        ul.append(li);
                    }
                }
                catch (ex) {
                    console.error(ex);
                }
            }

            const postCommentForms = document.querySelectorAll('.postCommentForm');
            for(let i of postCommentForms) {
                i.addEventListener('submit', addCommentAjax);
            };


            //show textarea for write comment
            function showCommentForm (e) {
                const wrapper = e.target.closest('.answer-actions').nextElementSibling;
                const openedInput = document.querySelector('.show.comment-form');
                if(openedInput)
                    openedInput.classList.remove('show');
                wrapper.classList.add('show');
            }

            const btnCommentList = document.querySelectorAll('.add-comment-btn');
            for(let i of btnCommentList) {
                i.addEventListener('click', showCommentForm)
            }
            // increase textarea with \n
            $('#text').each(function () {
                this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;');
            }).on('input', function () {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });

            /*

             var doctype = document.implementation.createDocumentType( 'html', '', '');
                            var dom = document.implementation.createDocument('', 'html', doctype);
                            const parser = new DOMParser();

             */
        </script>
    </div>

    <div class="answer-example hidden">
        @include('.partial_view.question.answer')
    </div>


@endsection

<script>
    //TODO: make profile for user
    //TODO: beforeunload if file exist and delete adapter

    //TODO: search profile, tags, questions

</script>
