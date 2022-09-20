<div class="line_customer formSection ">   
<div class="inner">
 <div class="heading">
 お客様名
 </div>
 <ul v-for="(line_list, index) in lines_customers">
 	<li>
				<a v-bind:href='`/lines?userid=${line_list.lines_customers_userid}`' class="link">
 		@{{ line_list.lines_customers_name }}

 		</a>
        <span v-if="line_list.lines_messages_to_userid!==line_list.lines_customers_userid" class="new_message">New</span>

 	</li>
 </ul>
 


</div>

</div>