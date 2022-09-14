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
 	</li>
 </ul>
 


</div>

</div>