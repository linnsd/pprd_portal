@extends('adminlte::page')

@section('title', 'Map Dashboard')

@section('content_header')

@stop

@section('content')

<div class="row justify-content-center">
  <div class="col-md-6">
       <div id="map"></div>
  </div>
  <div class="col-md-6">

  </div>

       
</div>
@stop



@section('css')
 <style>
    tspan{
      display: none !important;
    }
  </style>
@stop



@section('js')

@stop

@section('hjs')

<script>
  // $(function() {
      var simplemaps_countrymap_mapdata={
        main_settings: {
          //General settings
          width: "400", //or 'responsive'
          background_color: "#FFFFFF",
          background_transparent: "yes",
          border_color: "#ffffff",
          pop_ups: "detect",
          
          //State defaults
          state_description: "State description",
          state_color: "#88A4BC",
          state_hover_color: "#3B729F",
          state_url: "www.google.com",
          border_size: 1.5,
          all_states_inactive: "no",
          all_states_zoomable: "yes",
          
          //Location defaults
          location_description: "Location description",
          location_url: "www.google.com",
          location_color: "#FF0067",
          location_opacity: 0.8,
          location_hover_opacity: 1,
          location_size: 25,
          location_type: "square",
          location_image_source: "frog.png",
          location_border_color: "#FFFFFF",
          location_border: 2,
          location_hover_border: 2.5,
          all_locations_inactive: "no",
          all_locations_hidden: "no",
          
          //Label defaults
          label_color: "#d5ddec",
          label_hover_color: "#d5ddec",
          label_size: 22,
          label_font: "Arial",
          hide_labels: "no",
          hide_eastern_labels: "no",
         
          //Zoom settings
          zoom: "yes",
          manual_zoom: "yes",
          back_image: "no",
          initial_back: "no",
          initial_zoom: "-1",
          initial_zoom_solo: "no",
          region_opacity: 1,
          region_hover_opacity: 0.6,
          zoom_out_incrementally: "yes",
          zoom_percentage: 0.99,
          zoom_time: 0.5,
          
          //Popup settings
          popup_color: "white",
          popup_opacity: 0.9,
          popup_shadow: 1,
          popup_corners: 5,
          popup_font: "12px/1.5 Verdana, Arial, Helvetica, sans-serif",
          popup_nocss: "no",
          
          //Advanced settings
          div: "map",
          auto_load: "yes",
          url_new_tab: "no",
          images_directory: "default",
          fade_time: 0.1,
          link_text: "View Website"
        },
        state_specific: {
          MMR2473: {
            name: "Kayah",
            description: "default",
            color: "#f90c66",
            hover_color: "#4fade1",
            url: "https://google.com"
          },
          MMR3266: {
            name: "Kayin",
            description: "default",
            color: "#f90c66",
            hover_color: "#4fade1",
            url: "https://google.com"
          },
          MMR3267: {
            name: "Mandalay",
            description: "default",
            color: "#f90c66",
            hover_color: "#4fade1",
            url: "https://google.com"
          },
          MMR3268: {
            name: "Bago",
            description: "default",
            color: "#f90c66",
            hover_color: "#4fade1",
            url: "https://google.com"
          },
          MMR3269: {
            name: "Yangon",
            description: "default",
            color: "#f3b23c",
            hover_color: "#4fade1",
            url: "https://google.com"
          },
          MMR3270: {
            name: "Mon",
            description: "default",
            color: "#8cd5f7",
            hover_color: "#4fade1",
            url: "https://google.com"
          },
          MMR3273: {
            name: "Rakhine",
            description: "default",
            color: "#7bea06",
            hover_color: "#4fade1",
            url: "https://google.com"
          },
          MMR3274: {
            name: "Chin",
            description: "default",
            color: "#f90c66",
            hover_color: "#4fade1",
            url: "https://google.com"
          },
          MMR3275: {
            name: "Ayeyarwady",
            description: "default",
            color: "#f90c66",
            hover_color: "#4fade1",
            url: "https://google.com"
          },
          MMR3276: {
            name: "Magway",
            description: "default",
            color: "#8cd5f7",
            hover_color: "#4fade1",
            url: "https://google.com"
          },
          MMR3277: {
            name: "Shan",
            description: "default",
            color: "#f6b9fd",
            hover_color: "#4fade1",
            url: "https://google.com"
          },
          MMR3279: {
            name: "Tanintharyi",
            description: "default",
            color: "#f3b23c",
            hover_color: "#4fade1",
            url: "https://google.com"
          },
          MMR3296: {
            name: "Kachin",
            description: "123",
            color: "#f90c66",
            hover_color: "#4fade1",
            url: "https://google.com"
          },
          MMR3302: {
            name: "Sagaing",
            description: "default",
            color: "#7bea06",
            hover_color: "#4fade1",
            url: "https://google.com",
            hide:"no",
            pulse:"yes",
            anchor:'middle'
          }
        },
        locations: {
          "0": {
            lat: "19.745",
            lng: "96.129722",
            name: "Nay Pyi Taw",
            description: "default",
            color: "#4eade1",
            hover_color: "#4fade1",
            url: "https://google.com",
            // hide:"no",
            // pulse:"yes",
            // pulse_size:"5",
            type:"marker",
            // anchor:'start'
          },
          "1": {
            lat: "19.728893",
            lng: "96.075519",
            name: "Test",
            description: "test",
            color: "#4eade1",
            hover_color: "#4fade1",
            url: "https://google.com",
            // hide:"no",
            // pulse:"yes",  , 
            // pulse_size:"5",
            type:"marker",
            // anchor:'start'
          },
           "2": {
            lat: "19.615674",
            lng: "96.131896",
            name: "Test2",
            description: "test2",
            color: "#f90c66",
            hover_color: "#4fade1",
            url: "https://google.com",
            // hide:"no",
            // pulse:"yes", , 
            // pulse_size:"5",
            type:"marker",
            // anchor:'start'
          },
          "3": {
            lat: "19.737043", 
            lng: "96.175081",
            name: "Nay Pyi Taw",
            description: "default",
            color: "#4eade1",
            hover_color: "#4fade1",
            url: "https://google.com",
            // hide:"no",
            // pulse:"yes",
            // pulse_size:"5",
            type:"marker",
            // anchor:'start'
          },
          "4": {
            lat: "19.740713",
            lng: "96.207454",
            name: "Test",
            description: "test",
            color: "#4eade1",
            hover_color: "#4fade1",
            url: "https://google.com",
            // hide:"no",
            // pulse:"yes", 19.740713, 96.207454  
            // pulse_size:"5",
            type:"marker",
            // anchor:'start'
          },
           "5": {
            lat: "19.746832",
            lng: "96.203860",
            name: "Test2",
            description: "test2",
            color: "#f90c66",
            hover_color: "#4fade1",
            url: "https://google.com",
            // hide:"no",
            // pulse:"yes",  19.746832, 96.203860
            // pulse_size:"5",
            type:"marker",
            // anchor:'start'
          },
          




        }
      };
  // });
</script>
<script type="text/javascript" src="{{ asset('js/countrymap.js') }}"></script>
@stop
