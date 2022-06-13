
<div class="row my-3">
    <div class="row">
        <div class="col-lg-3 my-3">
            <h3>Stats</h3>
            <div class="row">
                <div class="col col-lg-6 my-3">
                    <h6>1</h6>
                    <div>Reputation</div>
                </div>
                <div class="col col-lg-6 my-3">
                    <h6>1</h6>
                    <div>reached</div>
                </div>
                <div class="col col-lg-6 my-3">
                    <h6>{{ count($user->answers) }}</h6>
                    <div>answers</div>
                </div>
                <div class="col col-lg-6 my-3">
                    <h6>{{ count($user->questions) }}</h6>
                    <div>questions</div>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            @if( Auth::user() !== null && Auth::user()->id == $user->id)
                <div class="col-lg-12">
                    <h3>About</h3>
                    <div class="profile-large-content mb-5">
                        <div class="mx-auto max-inn-content about-content">

                            @empty($user->about)
                                Your about me section is currently blank. Would you like to add one?
                                <a href="{{route('users.edit', [ 'lang' => app()->getLocale(), 'id' => $user->id])}}">
                                    Edit profile
                                </a>
                            @endempty

                            @isset($user->about)
                                    <style>
                                        .about-content {
                                            margin: 0;
                                            width: auto;
                                            max-width: 100%;
                                            text-align: left;
                                            overflow-wrap: break-word;
                                        }
                                    </style>
                                {{ $user->about }}
                            @endisset
                        </div>
                    </div>
                </div>
{{--                <div class="col-lg-12">--}}
{{--                    <h3>Badges</h3>--}}
{{--                    <div class="profile-large-content mb-5">--}}
{{--                        <div class="mx-auto max-inn-content">--}}
{{--                            You have not earned any <a href="">badges</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

                <div class="col-lg-12">
                   @include('partial_view.posts.index')
                </div>


            @else
                <div class="row w-100">
                    <h2>Badges</h2>
                    <div class="d-flex flex-wrap justify-content-center mt-4">
                        <div class="badges-item">
                            <h3>1 gold badge</h3>
                        </div>
                        <div class="badges-item">
                            <h3>1 gold badge</h3>
                        </div>
                        <div class="badges-item">
                            <h3>1 gold badge</h3>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-12 d-flex justify-content-between">
                        <div class="tag">
                            Tag name
                        </div>
                        <div class="tag-stat d-flex">
                            <div class="mx-2">
                                <span>11</span>
                                <span>score</span>
                            </div>
                            <div class="mx-2">
                                <span>21</span>
                                <span>posts</span>
                            </div>
                            <div class="mx-2">
                                <span>38</span>
                                <span>posts %</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-between">
                        <div class="tag">
                            Tag name
                        </div>
                        <div class="tag-stat d-flex">
                            <div class="mx-2">
                                <span>11</span>
                                <span>score</span>
                            </div>
                            <div class="mx-2">
                                <span>21</span>
                                <span>posts</span>
                            </div>
                            <div class="mx-2">
                                <span>38</span>
                                <span>posts %</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-between">
                        <div class="tag">
                            Tag name
                        </div>
                        <div class="tag-stat d-flex">
                            <div class="mx-2">
                                <span>11</span>
                                <span>score</span>
                            </div>
                            <div class="mx-2">
                                <span>21</span>
                                <span>posts</span>
                            </div>
                            <div class="mx-2">
                                <span>38</span>
                                <span>posts %</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <h3>Top questions</h3>
                    <hr>
                    <div class="col-12 d-flex justify-content-between my-1">
                        <div>
                            <span>Likes: 20</span>
                            <a class="mx-3" href="/questions/1">useState always is default value in itself</a>
                        </div>
                        <div class="q-date">
                            May 13, 2019
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-between my-1">
                        <div>
                            <span>Likes: 20</span>
                            <a class="mx-3" href="/questions/1">useState always is default value in itself</a>
                        </div>
                        <div class="q-date">
                            May 13, 2019
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-between my-1">
                        <div>
                            <span>Likes: 20</span>
                            <a class="mx-3" href="/questions/1">useState always is default value in itself</a>
                        </div>
                        <div class="q-date">
                            May 13, 2019
                        </div>
                    </div>
                </div>

            @endif
        </div>

    </div>
</div>
