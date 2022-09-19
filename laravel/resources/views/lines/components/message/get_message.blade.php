<div class="inner">
    
 
<div class="messageBlock">
    <div class="wrap"   v-for="(line_list, index) in lines_list">
        

{{-- 受信したメッセージのみ表示 --}}
<div class="messageWrap" v-if="line_list.lines_messages.lines_customers_userid == line_list.lines_messages.lines_messages_from_userid">
    <div class="flexMessge leftMessage">
        <div class="imgFlex">
            <div class="circle"></div>
        </div>
        <div class="textFlex">
            <div class="headingBlock">
                <div class="name">
                    @{{ line_list.lines_customers.lines_customers_name }}
                </div>
                <div class="time">
                    {{-- 20時32分【4月30日】 --}}

                        @{{ moment(line_list.lines_messages.created_at ) }}

                    {{-- @{{ line_list.lines_customers.lines_customers_name }} --}}

                </div>
            </div>
                <div class="content white-space">
                            @{{ change_name(line_list.lines_messages.lines_messages_text) }}
                    
                    {{-- @{{ line_list.lines_messages.lines_messages_text }} --}}
                    {{-- @{{ line_list.lines_messages.lines_messages_text }} --}}
             {{--        <pre>
                    @{{ line_list.lines_messages }}
                    </pre> --}}
                </div>
        </div>

    </div>
    
</div>




{{-- 送信したメッセージのみ表示 --}}
<div class="messageWrap" v-if="line_list.lines_messages.lines_customers_userid !== line_list.lines_messages.lines_messages_from_userid">
<div class="flexMessge rightMessage">

    <div class="textFlex">
        <div class="headingBlock">
            <div class="name">
               私
            </div>
            <div class="time">

                    @{{ moment(line_list.lines_messages.created_at ) }}

            </div>
        </div>
            <div class="content white-space">
                            @{{ change_name(line_list.lines_messages.lines_messages_text) }}
                {{-- @{{ line_list.lines_messages.lines_messages_text }} --}}
                       {{--          <pre>
                    @{{ line_list.lines_messages }}
                    </pre> --}}
            </div>
    </div>

</div>
    
</div>



    </div>







<div class="end_message"></div>
</div>


</div>