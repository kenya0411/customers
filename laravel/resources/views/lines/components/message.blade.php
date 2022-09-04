<div class="detailFrom formSection ">   
<div class="inner">
    
 
        <dl>
         <dt>購入日</dt>
         <dd>
        <div class="" v-for="(line_list, index) in lines_list">
                   @{{ line_list.lines_messages.lines_messages_text }}

</div>

                   {{-- @{{ moment(lines_messages.created_at ) }} --}}
</dd>



</dl>

<div class="btnWrap">
    {{-- <div class="sendBtn pointer" v-on:click="submit_update(orders.id)">編集する</div> --}}
</div>
<div class="deleteWrap">
    {{-- <div class="delete pointer" v-on:click="submit_delete(orders.id)">削除する</div> --}}
</div>

</div>

</div>