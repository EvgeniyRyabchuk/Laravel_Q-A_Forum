


@if ($paginator->hasPages())


    <nav aria-label="Page navigation example"  id="paginator">
        <ul class="pagination justify-content-center">
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}">Previous</a></li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled">{{ $element }}</li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <a class="page-link">{{ $page }}</a>
                            </li>
                        @else
                            {{-- {{ !is_null($queryParams['perPage']) ? $url . "&perPage=" . $queryParams['perPage']  : $url  }} "--}}
                            <li class="page-item">
                                <a class="page-link" href="{{ request()->fullUrlWithQuery($queryParams + ['page' => $page, 'ajax' => NULL]) }}">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a>
                </li>
            @else
                <li class="page-item disabled">
                    <a class="page-link" href="#">Next</a>
                </li>
            @endif
        </ul>
    </nav>
    <div>
        <button id="nextPageBtn" type="button" class="btn btn-primary">Show me + {{ $queryParams['perPage'] ?? '+5' }}</button>
    </div>
    <script>


        function parseHTML(html) {
            let t = document.createElement('template');
            t.innerHTML = html;
            return t.content;
        }



        console.log(document.getElementById('nextPageBtn'));
        let url = '';
        let pageCount = {{$paginator->currentPage()}};
        const totalCount = {{ $paginator->lastPage() }};
        if(pageCount >= totalCount) {
            document.getElementById('nextPageBtn').classList.add('disabled');
        }
        const onBtnNextClick = async () => {
            console.log(totalCount, pageCount, url);
            if(pageCount >= totalCount) {
                return;
            }

            if(url === '') {
                url = '{!! request()->fullUrlWithQuery(array_merge($queryParams,['page' => $paginator->currentPage()+1],[ 'ajax' => '1'])) !!}';
                pageCount++;
            } else {
                url = url.replace(`page=${pageCount}`, `page=${++pageCount}`);
            }
            if(pageCount >= totalCount) {
                document.getElementById('nextPageBtn').classList.add('disabled');
            }
            const data = await fetch(url);
            const htmlText = await data.text();
            let doc = parseHTML(htmlText);

            const items = doc.querySelectorAll('.card-body');
            const list = document.getElementById('question-list');
            for(let i of items) {
                list.appendChild(i);
            }

            const fetchPaginator = doc.querySelector('#paginator');
            const thisPaginator = document.querySelector('#paginator');
            thisPaginator.innerHTML = '';

            for(let i of fetchPaginator.children) {
                // console.log(i)
                thisPaginator.appendChild(i);
            }

        }

        document.getElementById("nextPageBtn").addEventListener('click', onBtnNextClick);


    </script>


@endif



