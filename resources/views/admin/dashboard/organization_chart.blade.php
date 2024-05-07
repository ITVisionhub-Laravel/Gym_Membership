<x-admin>
  <style> 

  #tree {
    background-color: rgb(225, 222, 222);
    width: 100%;
    height: 100%;
  }

  .field_0 {
    text-decoration-color: red;
    font-family: Impact;
  }

  [data-n-id] circle {
    fill: #7ca389;
  }
</style>  
<div >
  <div data-staffs="{{ json_encode($staffs) }}" id="tree"></div>
</div>
{{--  <x-script />  --}}
<script>
  // JavaScript
      var staffsData = JSON.parse(document.getElementById('tree').getAttribute('data-staffs'));
      
      var staffs = staffsData.map(function(staff) {  
      return {
        id: staff.position_id,
        pid: staff.reporting_to,
        name: staff.name,
        title: staff.position.name,
        img: staff.image,
        // Add other properties as needed
        };
      });  
      var chart = new OrgChart(document.getElementById("tree"), {
      //template: "olivia",
      template: "ula",
      enableSearch: false,
      enableDragDrop: false,
      mouseScrool: OrgChart.action.none,
      scaleInitial: OrgChart.match.boundary,
      
      nodeBinding: {
      field_0: "name",
      field_1: "title",
      img_0: "img"
      },
      nodes: staffs
      });
</script>
</x-admin>
