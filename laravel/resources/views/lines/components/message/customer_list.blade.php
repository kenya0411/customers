<div class="line_customer formSection ">   
<div class="inner">
 <div class="heading">
 お客様名
 </div>
 <ul v-for="(line_list, index) in lines_customers">
 	<li>
        <a v-bind:href='`/lines?userid=${line_list.lines_customers_userid}`' class="link">

        <div class="arrow"></div>
        <div v-if="line_list.lines_messages_to_userid!==line_list.lines_customers_userid && line_list.lines_messages_ngword!==true" class="new_message"><span>要返信</span></div>
        <div class="link_name">
            
 		@{{ line_list.lines_customers_name }}
        </div>

 		</a>
        
 	</li>
 </ul>
 


</div>

</div>