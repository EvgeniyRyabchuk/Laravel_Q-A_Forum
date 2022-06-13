<div class="section-head">
    <div class="s-left">
        <h3>Top Posts</h3>
    </div>
    <div class="s-right">
        <div class="section-filter">
            <ul>
                <li>
                    <button class="section-head-btn" data-type="all">All</button>
                </li>
                <li>
                    <button class="section-head-btn" data-type="questions">Questions</button>
                </li>
                <li>
                    <button class="section-head-btn" data-type="answers">Answers</button>
                </li>
            </ul>
        </div>
        <div class="section-sort">
            <ul>
                <li>
                    <button class="section-head-btn" data-sort="score">Score</button>
                </li>
                <li>
                    <button class="section-head-btn" data-sort="newest">Newest</button>
                </li>
            </ul>
        </div>
    </div>

</div>
@empty($questions)
    <div class="profile-large-content mb-5">
        <div class="mx-auto max-inn-content">
            Just getting started? Try answering a question!
        </div>
    </div>
@endempty

@isset($questions)
    <div class="post-container mb-5">
        @include('partial_view.question.short.index')
    </div>
@endisset


<script>
    let type = "all";
    let sort = "newest";
    const lang = `{{ app()->getLocale() }}`;

    const switchPostList = async (type, sort) => {
        console.log(type, sort);
        const url = '{{route('users.posts.short', [
                    'lang' => app()->getLocale(),
                    'userId' => $user->id,
                ])}}' + `?type=${type}&sort=${sort}`;

        const data = await fetch(url);
        const json = await data.json();
        const responseData = json.data;

        console.log(responseData)
        const container = document.querySelector('#question-list');
        container.innerHTML = '';

        for(let question of responseData) {
            const li = document.querySelector('.example-shot-question').querySelector('li').cloneNode(true);
            const postLink = `{{url('')}}/${lang}/questions/${question.id}`;
            li.querySelector('.card-title').querySelector('a').innerText = question.title;
            li.querySelector('.q-views').innerText = 'Views: ' + question.viewCount;
            li.querySelector('.q-views').innerText = 'Views: ' + question.viewCount;
            li.querySelector('.q-date').innerText = question.created_at;
            li.querySelector('.card-title').querySelector('a').setAttribute('href', postLink);
            container.append(li);
        }
    }

    document.querySelectorAll('[data-type]').forEach((element) => {
        element.addEventListener('click', async (e) => {
            const target = e.target;
            type = target.dataset.type;
            switchPostList(type, sort);

        });
    });
    document.querySelectorAll('[data-sort]').forEach((element) => {
        element.addEventListener('click', async (e) => {
            const target = e.target;
            sort = target.dataset.sort;
            switchPostList(type, sort);
        });
    });
</script>
