<div class="price_block">
  <div class="inner">
    
<div class="flex">
  <div class="flex3" v-if="search_year !== ''">
  <div v-html="search_year"></div><span>年</span>    
  </div>
  <div class="flex3" v-if="search_month !== ''">
  <div v-html="search_month"></div><span>月</span>
  </div>
    <div class="flex3">
  <div v-html="total_price"></div><span>円</span>
  </div>
  
  </div>
</div>
</div>