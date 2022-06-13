<div class="row">
    <div class="col-3">
        <div
                class="nav flex-column nav-pills text-center"
                id="v-pills-tab"
                role="tablist"
                aria-orientation="vertical">
            <a
                    class="nav-link {{ $tab == 'preferences' || $tab == '' || $tab == null ? 'active' : '' }} "
                    id="v-pills-home-tab"
                    data-mdb-toggle="pill"
                    href="{{route('users.setting', ['lang' => app()->getLocale(), 'userId' => $user->id, 'tab' => 'preferences'])}}"
                    role="tab"
                    aria-controls="v-pills-home"
                    aria-selected="true">Preferences</a>
            <a
                    class="nav-link {{ $tab == 'edit-email' ? 'active' : '' }}"
                    id="v-pills-profile-tab"
                    data-mdb-toggle="pill"
                    href="{{route('users.setting', ['lang' => app()->getLocale(), 'userId' => $user->id, 'tab' => 'edit-email'])}}"
                    role="tab"
                    aria-controls="v-pills-profile"
                    aria-selected="false"
            >Edit email</a>
            <a
                    class="nav-link {{ $tab == 'delete-account' ? 'active' : '' }}"
                    id="v-pills-messages-tab"
                    data-mdb-toggle="pill"
                    href="{{route('users.setting', ['lang' => app()->getLocale(), 'userId' => $user->id, 'tab' => 'delete-account'])}}"
                    role="tab"
                    aria-controls="v-pills-messages"
                    aria-selected="false"
            >Delete account</a>
        </div>
    </div>

    <div class="col-9">
        <!-- Tab content -->
        <div class="tab-content" id="v-pills-tabContent">
            @isset($tab)
                @switch($tab)
                    @case('activity')
                        @include('user.tabs.setting.preferences')
                    @break
                    @case('answers')
                        @include('user.tabs.setting.edit-email')
                    @break
                    @case('questions')
                        @include('user.tabs.setting.delete-account')
                    @break
                    @default
                        @include('user.tabs.setting.preferences')
                    @break

                @endswitch
            @endisset

            @empty($tab)
                @include('user.tabs.setting.preferences')
            @endempty
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
