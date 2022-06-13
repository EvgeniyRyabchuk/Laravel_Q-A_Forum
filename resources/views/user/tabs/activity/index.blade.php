<div class="row">
    <div class="col-3">
        <div
            class="nav flex-column nav-pills text-center"
            id="v-pills-tab"
            role="tablist"
            aria-orientation="vertical">
            <a
                class="nav-link {{ $tab == 'summary' || $tab == 'activity' ? 'active' : '' }} "
                id="v-pills-home-tab"
                data-mdb-toggle="pill"
                href="{{route('users.show', ['lang' => app()->getLocale(), 'userId' => $user->id, 'tab' => 'summary'])}}"
                role="tab"
                aria-controls="v-pills-home"
                aria-selected="true">Summary</a>
            <a
                class="nav-link {{ $tab == 'answers' ? 'active' : '' }}"
                id="v-pills-profile-tab"
                data-mdb-toggle="pill"
                href="{{route('users.show', ['lang' => app()->getLocale(), 'userId' => $user->id, 'tab' => 'answers'])}}"
                role="tab"
                aria-controls="v-pills-profile"
                aria-selected="false"
            >Answers</a>
            <a
                class="nav-link {{ $tab == 'questions' ? 'active' : '' }}"
                id="v-pills-messages-tab"
                data-mdb-toggle="pill"
                href="{{route('users.show', ['lang' => app()->getLocale(), 'userId' => $user->id, 'tab' => 'questions'])}}"
                role="tab"
                aria-controls="v-pills-messages"
                aria-selected="false"
            >Questions</a>
        </div>
    </div>

    <div class="col-9">
        <!-- Tab content -->
        <div class="tab-content" id="v-pills-tabContent">
            @isset($tab)
                @switch($tab)
                    @case('activity')
                    @include('user.tabs.activity.summary')
                    @break
                    @case('answers')
                    @include('user.tabs.activity.answers')
                    @break
                    @case('questions')
                    @include('user.tabs.activity.questions')
                    @break
                    @default
                    @include('user.tabs.activity.summary')
                    @break

                @endswitch
            @endisset
            {{--            <div--}}
            {{--                class="tab-pane fade show active"--}}
            {{--                id="v-pills-home"--}}
            {{--                role="tabpanel"--}}
            {{--                aria-labelledby="v-pills-home-tab">--}}
            {{--                Home content--}}
            {{--            </div>--}}
            {{--            <div--}}
            {{--                class="tab-pane fade"--}}
            {{--                id="v-pills-profile"--}}
            {{--                role="tabpanel"--}}
            {{--                aria-labelledby="v-pills-profile-tab">--}}
            {{--                Profile content--}}
            {{--            </div>--}}
            {{--            <div--}}
            {{--                class="tab-pane fade"--}}
            {{--                id="v-pills-messages"--}}
            {{--                role="tabpanel"--}}
            {{--                aria-labelledby="v-pills-messages-tab">--}}
            {{--                Messages content--}}
            {{--            </div>--}}
        </div>
        <!-- Tab content -->
    </div>
</div>


