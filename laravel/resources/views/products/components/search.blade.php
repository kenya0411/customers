    <section class="searchBlock maxWid mbbPad">
        <form action="/products/search" method="get" >
            @csrf
            <input type="hidden" name="search" value="search">

            <div class="flex">
                <div class="flex4">
                    <select name="search_persons_id">
                        <option value="0">▼person</option>

                        @foreach ($persons as $person)
                        @if($person->persons_id == $dates['persons_id'])
                        <option value="{{ $person->persons_id}}" selected>{{ $person->persons_name}}</option>
                        @else
                        <option value="{{ $person->persons_id}}">{{ $person->persons_name}}</option>

                        @endif
                        @endforeach
                    </select>

                </div>
                <div class="flex4">
                    <select name="search_date_year">

                        @for ($i = 2021; $i <= 2022; $i++)
                        @if($i == $dates['year'])
                        <option value="{{ $i}}" selected>{{ $i}}年</option>
                        @else
                        <option value="{{ $i}}">{{ $i}}年</option>

                        @endif

                        @endfor
                    </select>

                </div>
                <div class="flex4">
                    <select name="search_date_month">
                        @for ($i = 1; $i <= 12; $i++)
                        @if($i == $dates['month'])
                        <option value="{{ $i}}" selected>{{ $i}}月</option>
                        @else
                        <option value="{{ $i}}">{{ $i}}月</option>

                        @endif
                        @endfor
                    </select>

                </div>
                <div class="flex4">
                    <input type="submit" class="searchBtn" value="検索">


                </div>
            </div>



        </form>
    </section>
