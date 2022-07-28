@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
  @if(auth()->user()->role_id==1 && auth()->user()->loginId!='user1')
      <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                      <div align="center">
                          <h3 style="color: #3b1d82;" class="unicode">Petroleum Products Regulatory Department</h3>
                          <h4 style="color: #3b1d82;" class="unicode">(PPRD)</h4>   
                      </div>
                      
                      <br>
                  </div>

                  <div class="card-body" align="center">
                   
                    <div class="row">

                        <div class="col-md-6">
                            <h5 class="col text-center" id="text-state">

                            </h5>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="bgo-shop rounded m-1 p-1 text-active text-center">
                                        <p>အရောင်းဆိုင်များ</p>
                                        <h5 id="text-station"></h5>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="bgo-car rounded m-1 p-1 text-success text-center">
                                        <p>ဆီသယ်ယာဉ်များ</p>
                                        <h5 id="text-car"></h5>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div id="myanmar-map" class="ml-auto mr-auto"></div>
                        </div>
                        <div class="col-md-6">
                            <h5 class="col text-center">
                                  &nbsp;
                            </h5>
                            <div class="table-responsive">
                              <table class="table table-bordered table-striped">
                                <thead>
                                <tr class="mm-header" style="background: #adabc5">
                                  <th >
                                    ပြည်နယ်/တိုင်း
                                  </th>
                                  <th >
                                    အရောင်းဆိုင်များ
                                  </th>
                                  <th >
                                    ဆီသယ်ယာဉ်များ
                                  </th>
                                  <th >
                                    အတည်ပြုပြီးယာဉ်များ
                                  </th>
                                </tr>
                                </thead>
                                <tbody>
                                  @php 
                                    $mm_num = ['၀','၁', '၂', '၃', '၄', '၅', '၆','၇','၈','၉'];
                                    $en_num = range(0, 9);
                                    $tableArr = json_decode($dataArr);
                                    $shoptotal =0;
                                    $cartotal = 0;
                                    $approvedcartotal = 0;

                                    foreach ($tableArr as $key => $value) {
                                        $shoptotal =$shoptotal + $value->shopcount;
                                        $cartotal = $cartotal + $value->carcount;
                                        $approvedcartotal = $approvedcartotal + $value->approvedCars;
                                        
                                    }
                                  @endphp
                                  @if(count($tableArr)>0)
                                      @foreach($tableArr as $tblarr)
                                      <tr>
                                        <td>{{ $tblarr->name }}</td>
                                        <td>{{ str_replace($en_num, $mm_num, $tblarr->shopcount) }}</td>
                                        <td>{{ str_replace($en_num, $mm_num, $tblarr->carcount) }}</td>
                                         <td>{{ str_replace($en_num, $mm_num, $tblarr->approvedCars) }}</td>
                                      </tr>
                                        
                                      @endforeach

                                      <tr style="background: #adabc5">
                                        <td>စုစုပေါင်း</td>
                                        <td>{{ str_replace($en_num, $mm_num, $shoptotal) }}</td>
                                        <td>{{ str_replace($en_num, $mm_num, $cartotal) }}</td>
                                        <td>{{ str_replace($en_num, $mm_num, $approvedcartotal) }}</td>
                                      </tr>
                                    @else
                                      <tr>
                                        <td colspan="3"><div class="empty">No results found.</div></td>
                                      </tr>
                                    @endif
                                </tbody>
                              </table>
                            </div>    
                          </div>
                    </div>
                  </div>
              </div>
          </div>
      </div>
  @else
   <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div align="center">
                  <img src="{{ asset('/img/logo.png') }}" alt="logo" style="width: 50%; margin-right: auto; margin-left: auto;">
                </div>
            </div>
        </div>
    </div>
  </div>
  @endif
@stop



@section('css')

    <link rel="stylesheet" href="{{ asset('css/web.css') }}"/>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
          integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
          crossorigin=""/>
@stop


@section('js')
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
            integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
            crossorigin=""></script>
<script type="text/javascript" src="{{ asset('js/map/states.js')}}"></script>
<script type="text/javascript">

    var json = {!! $dataArr !!};

    var objkey = Object.keys(json);
    let shoptotal = 0;
    let cartotal = 0
    for (const i of objkey) {
         shoptotal +=json[i]['shopcount'];
         cartotal +=json[i]['carcount'];
    }
    

    // let json = {
    //             "MMR001":{"name":"\u1000\u1001\u103b\u1004\u103a\u1015\u103c\u100a\u103a\u1014\u101a\u103a","townships":[
    //                     {"active":100,"confirmed":34,"deaths":30,"recovered":334,"color":"#7bea06"}
    //                 ]
    //             },
    //             "MMR002":{"name":"\u1000\u101a\u102c\u1038\u1015\u103c\u100a\u103a\u1014\u101a\u103a","townships":[
    //                     {"active":100,"confirmed":34,"deaths":30,"recovered":334,"color":"#E0E0E0"}
    //                 ]
    //             },
    //             "MMR003":{"name":"\u1000\u101b\u1004\u103a\u1015\u103c\u100a\u103a\u1014\u101a\u103a","townships":[
    //                     {"active":100,"confirmed":34,"deaths":30,"recovered":334,"color":"#FED976"}
    //                 ]
    //             },
    //             "MMR004":{"name":"\u1001\u103b\u1004\u103a\u1038\u1015\u103c\u100a\u103a\u1014\u101a\u103a","townships":[
    //                     {"active":100,"confirmed":34,"deaths":30,"recovered":334,"color":"#FEB24C"}
    //                 ]
    //             },
    //             "MMR005":{"name":"\u1005\u1005\u103a\u1000\u102d\u102f\u1004\u103a\u1038\u1010\u102d\u102f\u1004\u103a\u1038\u1012\u1031\u101e\u1000\u103c\u102e\u1038","townships":[]},"MMR006":{"name":"\u1010\u1014\u1004\u103a\u1039\u101e\u102c\u101b\u102e\u1010\u102d\u102f\u1004\u103a\u1038\u1012\u1031\u101e\u1000\u103c\u102e\u1038","townships":[]},"MMR007":{"name":"\u1015\u1032\u1001\u1030\u1038\u1010\u102d\u102f\u1004\u103a\u1038\u1012\u1031\u101e\u1000\u103c\u102e\u1038 (\u1021\u101b\u103e\u1031\u1037)","townships":[]},"MMR008":{"name":"\u1015\u1032\u1001\u1030\u1038\u1010\u102d\u102f\u1004\u103a\u1038\u1012\u1031\u101e\u1000\u103c\u102e\u1038 (\u1021\u1014\u1031\u102c\u1000\u103a)","townships":[]},"MMR009":{"name":"\u1019\u1000\u103d\u1031\u1038\u1010\u102d\u102f\u1004\u103a\u1038\u1012\u1031\u101e\u1000\u103c\u102e\u1038","townships":[]},"MMR010":{"name":"\u1019\u1014\u1039\u1010\u101c\u1031\u1038\u1010\u102d\u102f\u1004\u103a\u1038\u1012\u1031\u101e\u1000\u103c\u102e\u1038","townships":[]},"MMR011":{"name":"\u1019\u103d\u1014\u103a\u1015\u103c\u100a\u103a\u1014\u101a\u103a","townships":[]},"MMR012":{"name":"\u101b\u1001\u102d\u102f\u1004\u103a\u1015\u103c\u100a\u103a\u1014\u101a\u103a","townships":[]},"MMR013":{"name":"\u101b\u1014\u103a\u1000\u102f\u1014\u103a\u1010\u102d\u102f\u1004\u103a\u1038\u1012\u1031\u101e\u1000\u103c\u102e\u1038","townships":[]},"MMR014":{"name":"\u101b\u103e\u1019\u103a\u1038\u1015\u103c\u100a\u103a\u1014\u101a\u103a (\u1010\u1031\u102c\u1004\u103a)","townships":[]},"MMR015":{"name":"\u101b\u103e\u1019\u103a\u1038\u1015\u103c\u100a\u103a\u1014\u101a\u103a (\u1019\u103c\u1031\u102c\u1000\u103a)","townships":[]},"MMR016":{"name":"\u101b\u103e\u1019\u103a\u1038\u1015\u103c\u100a\u103a\u1014\u101a\u103a (\u1021\u101b\u103e\u1031\u1037)","townships":[]},"MMR017":{"name":"\u1027\u101b\u102c\u101d\u1010\u102e\u1010\u102d\u102f\u1004\u103a\u1038\u1012\u1031\u101e\u1000\u103c\u102e\u1038","townships":[]},"MMR018":{"name":"\u1014\u1031\u1015\u103c\u100a\u103a\u1010\u1031\u102c\u103a","townships":[]}};




    let map = L.map('myanmar-map', {
        zoomControl: false,
        minZoom: 5.3,
        maxZoom: 5.3,
        zoomSnap: 0,
        tap: false,
        dragging: false
    }).setView([19, 95.95], 5.3);

    map.scrollWheelZoom.disable();
    map.doubleClickZoom.disable();

    let max = 0;
    let keys = Object.keys(json);

    function getColorFromStates(d) {
       
        var color = '';
        var objkey = Object.keys(json);
        for (const i of objkey) {
            
            if (json[i]['mmr_code'] === d[0]) {
                color +=json[i]['color'];
            }
        }
        return color;
    }


    var legend = L.control({position: 'bottomleft'});

    legend.onAdd = function (map) {
        var div = L.DomUtil.create('div', 'info legend');
        return div;
    };

    function style(feature) {
        return {
            weight: 2,
            opacity: 1,
            color: 'white',
            dashArray: '3',
            fillOpacity: 0.8,
            fillColor: getColorFromStates(feature.properties.ST_PCODE)
        };
    }

    var current = "";

    function highlightFeature(e) {
        let layer = e.target;
        layer.setStyle({
            weight: 2,
            color: '#FF0000',
            dashArray: '',
            fillOpacity: 0.7
        });
        if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
            layer.bringToFront();
        }
        update(layer.feature.properties.ST_PCODE);
    }

    function update(pcodes) {
        var name = '';
        let shop = 0;
        let car = 0;

        var objkey = Object.keys(json);
        for (const i of objkey) {
            for (const SR_PCODE of pcodes) {
                if (json[i]['mmr_code'] === SR_PCODE) {
                // if (pcodes.includes(json[i]['mmr_code'])) {
                        name = "";
                        
                        shop += json[i]['shopcount'];
                        car += json[i]['carcount'];
                        name += json[i]['name']; 
                }
            }
        }

        if (name === "ရှမ်းပြည်နယ် တောင်ပိုင်း" || name === "ရှမ်းပြည်နယ် အရှေ့ပိုင်း" || name === "ရှမ်းပြည်နယ် မြောက်ပိုင်း"  ){
            name = "";
            name ="ရှမ်း";
        }
        document.getElementById('text-state').innerText = name;
        document.getElementById("text-station").innerText = myanmarNumber(shop);
        document.getElementById("text-car").innerText = myanmarNumber(car);
    }

    function resetHighlight(e) {
        geojson.resetStyle(e.target);
        document.getElementById('text-state').innerText = "မြန်မာနိုင်ငံ";
        document.getElementById("text-station").innerText = myanmarNumber(shoptotal);
        document.getElementById("text-car").innerText = myanmarNumber(cartotal);
    }

    function go(e) {
        let layer = e.target;
        if (current === layer.feature.properties.ST_PCODE[0]) {
            geojson.resetStyle(e.target);
            document.getElementById('text-state').innerText = "မြန်မာနိုင်ငံ";
            document.getElementById("text-station").innerText = myanmarNumber(shoptotal);
            document.getElementById("text-car").innerText = myanmarNumber(cartotal);
            $('#main').fadeOut(100, newpage);
            newLocation = 'state.html?SR_PCODE=' + layer.feature.properties.ST_PCODE[0];
        } else {
            current = layer.feature.properties.ST_PCODE[0];
        }
    }

    function newpage() {
        window.location = newLocation;
    }

    function onEachFeature(feature, layer) {
        layer.on({
            mouseover: highlightFeature,
            mouseout: resetHighlight,
            click: go,
        });
    }

    legend.addTo(map);

    geojson = L.geoJson(statesData, {
        style: style,
        onEachFeature: onEachFeature
    }).addTo(map);

    function myanmarNumber(num) {
        let numbers = {
            "0": "၀",
            "1": "၁",
            "2": "၂",
            "3": "၃",
            "4": "၄",
            "5": "၅",
            "6": "၆",
            "7": "၇",
            "8": "၈",
            "9": "၉"
        };
        let st = "";
        let n = num.toString();
        for (var i = 0; i < n.length; i++) {
            if (typeof numbers[n.charAt(i)] != "undefined") {
                st += numbers[n.charAt(i)];
            } else {
                st += n.charAt(i);
            }
        }
        return st;
    }

    /*function addCommas(n) {
        var rx = /(\d+)(\d{3})/;
        return String(n).replace(/^\d+/, function (w) {
            while (rx.test(w)) {
                w = w.replace(rx, '$1,$2');
            }
            return w;
        });
    }*/

    document.getElementById('text-state').innerText = "မြန်မာနိုင်ငံ";
    document.getElementById("text-station").innerText = myanmarNumber(shoptotal);
    document.getElementById("text-car").innerText = myanmarNumber(cartotal);
</script>
<script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>

<script type="text/javascript">
   
    $(document).ready(function () {
        $('#main').css('display', 'none');
        $('#main').fadeIn(200);
    });
</script>
@stop
