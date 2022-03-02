    <div class="searchBlock ">
        <form action="/customers/search" method="get" >
            @csrf
            <input type="hidden" name="search" value="search">

            <div class="flex">
                <div class="flex4">
                    <div class="search_input">
<input type="text" class="font-awesome" placeholder="&#xF002;" name="search_text" v-model="search_text" >
                    </div>

</div>
            </select>
                <div class="flex4">
                   <select name="date_year" v-model="search_date_year" id="">
                        @php
                        $d = now();
                        $year = $d->format('Y');
                        $year_add = $d->addYears(1)->format('Y');

                        @endphp
                @for ($i = 2021; $i <= $year_add ; $i++)
                <option value="{{ $i}}">{{ $i }}年</option>
                @endfor

            </select>

                </div>
                <div class="flex4">
            <select name="date_month" v-model="search_date_month" id="">
                @for ($i = 1; $i <= 12; $i++)
                <option value="{{ $i}}">{{ $i }}月</option>
                @endfor
                  </select>

                </div>
                {{-- <div class="flex4"> --}}
                    {{-- <input type="submit" class="searchBtn" value="検索"> --}}


                {{-- </div> --}}
                                <div class="flex4">
 <select name="search_persons_id" v-model="search_persons" id="">
      <option v-for="person in persons"  v-bind:value="person.persons_id" >@{{ person.persons_name }}</option>
                    
                        @foreach ($persons as $person)
                        @if($person->persons_id == $dates['persons_id'])
                        <option value="{{ $person->persons_id}}" selected>{{ $person->persons_name}}</option>
                        @else
                        <option value="{{ $person->persons_id}}">{{ $person->persons_name}}</option>

                        @endif
                        @endforeach
                    </select>

                </div>
            </div>



        </form>
    </div>
