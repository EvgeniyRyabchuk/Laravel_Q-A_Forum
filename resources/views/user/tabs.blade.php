<h1>Your profile</h1>

@auth
    @foreach (Auth::user()->roles as $role)
        @if ($role->name == 'admin')
            <a href="">Create post</a>
        @endif
        @if ($role->name == 'super_admin')
            <a href="">Create user</a>
        @endif
    @endforeach
@endauth

<div class="d-flex p-3 profile-head">
    <div class="avatar-wrapper">
        <img width="100" height="100" class="avatar"
             src="/storage/{{$user->avatar}}"
             alt=""/>
    </div>
    <div class="user-meta">
        <h1>{{ $user->name }}</h1>
        <hr>
        <ul class="d-flex flex-wrap">
            <li class="meta-item">some-text</li>
            <li class="meta-item">some-text</li>
            <li class="meta-item">some-text</li>`
            <li class="meta-item">some-text</li>
        </ul>

        <a id="editLink" href="{{route('users.edit', [ 'lang' => app()->getLocale(), 'id' => $user->id])}}"
           class="btn btn-secondary">Edit profile</a>
    </div>
</div>


<div class="row my-3">
    <ul class="profile-tab">

        <li class="profile">
            <a href="{{ route('users.show', [ 'lang' => app()->getLocale(), 'userId' => $user->id, 'tab' => 'profile']) }}">Profile</a>
        </li>
        <li class="activity">
            <a href="{{ route('users.show', [ 'lang' => app()->getLocale(), 'userId' => $user->id, 'tab' => 'activity']) }}">Activity</a>
        </li>
        <li class="setting">
            <a href="{{route('users.setting', ['lang' => app()->getLocale(), 'userId' => $user->id])}}">Setting</a>
        </li>

        @foreach($tabList as $item)

            @if($item[0] == 'profile' && $tab == 'profile')
                <script>
                    document.querySelector('.profile').classList.add('active');
                </script>
            @else
                @if(in_array($tab, $tabList['activity']) || $tab == 'activity')
                    <script>
                        document.querySelector('.activity').classList.add('active');
                    </script>
                @endif
                @if(in_array($tab, $tabList['setting']) || $tab == '')
                    <script>
                        document.querySelector('.setting').classList.add('active');
                    </script>
                @endif
            @endif
        @endforeach
    </ul>
</div>
