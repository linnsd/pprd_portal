<html>
    <head>
    </head>
    <body>
      <table class="table table-bordered styled-table ">
         <thead>
            <tr>
                <th>ဆိုင်အမည်</th>
                <th>ပိုင်ရှင်/ကုမ္ပဏီ/အဖွဲ့အစည်းအမည်</th>
                <th>ကုမ္ပဏီ မှတ်ပုံတင်အမှတ်</th>
                <th>လုပ်ငန်းတည်နေရာ</th>
                <th>အဆင့်သက်မှတ်ချက်</th>
                <th>ထုတ်ပေးသည့်ရက်စွဲ</th>
                <th>သက်တမ်းကုန်ဆုံးရန်</th>
            </tr>
          
            <th>
               
            </th>
         </thead>
        @foreach ($fuel_shops as $shop)
            <tr>
                <td>{{ $shop->sd_name }}</td>
                <td>{{ $shop->owner }}</td>
                <td>{{ $shop->licence_no }}</td>
                <td>{{ $shop->address}}</td>
                <td>{{ $shop->grade}}</td>
                <td>{{date('d-m-Y',strtotime($shop->lic_issue_date))}}</td>
                <td>
                     @if($shop->lic_expire_date!='' || $shop->lic_expire_date!=null)
                        {{ date('d-m-Y', strtotime($shop->lic_expire_date ))}}
                    @endif
                </td>
              
                </tr>
        @endforeach
         <tbody>
             
         </tbody>
      </table>
    </body>
</html>