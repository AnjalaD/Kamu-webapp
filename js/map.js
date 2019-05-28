
/*
use HMap class as a singleton object
use only public functions
each map needs a container and its id

ex:
    <div style="width: auto; height: 400px" id="mapContainer"></div>
    <div style="width: auto; height: 400px" id="mapContainer2"></div>
    <div style="width: auto; height: 400px" id="mapContainer3"></div>


    <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.0/mapsjs-ui.css?dp-version=1542186754" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="https://js.api.here.com/v3/3.0/mapsjs-core.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://js.api.here.com/v3/3.0/mapsjs-service.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.0/mapsjs-ui.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.0/mapsjs-mapevents.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <script src="map.js" type="text/javascript"></script>
    <script>
        mymap = HMap.getInstance();
        mymap.showPointAndCenter({latitude:6.7949240,longitude:79.900755},'mapContainer','university');
        mymap.showPointAndCenter({latitude:7.029852,longitude:79.921640},'mapContainer2','ragama');
        mymap.showRouteFromAtoB({latitude:6.7949240,longitude:79.900755},{latitude:7.029852,longitude:79.921640},'mapContainer3');

    </script>
*/

class HMap {


    //private
    constructor() {
        //initialize communication with the platform
        this.platform = new H.service.Platform({
            'app_id': 'xRymLb0c3HeaIpvkn873',
            'app_code': 'nMKNammAMpBXJx4l3p9tgw',
            useHTTPS: true
        });
        this.pixelRatio = window.devicePixelRatio || 1;
        this.defaultLayers = this.platform.createDefaultLayers({
            tileSize: this.pixelRatio === 1 ? 256 : 512,
            ppi: this.pixelRatio === 1 ? undefined : 320
        });
    }

    static getInstance() {
        if (HMap.instance == null) {
            HMap.instance = new HMap();
        }
        return HMap.instance;
    }

    //private
    addMarkerToGroup(group, latitude, longitude, label = 'default marker',icon="") {
        // console.log(icon);
        if(icon==""){
            var marker = new H.map.Marker({ lat: latitude, lng: longitude });
        }else{
            var icon = new H.map.Icon(icon);
            var marker = new H.map.Marker({ lat: latitude, lng: longitude },{icon:icon});
        }
        var html = `<div>${label}</div>`
        marker.setData(html);
        group.addObject(marker);
        return marker;
    }

    //private
    setViewBubblesToGroup(group,ui) {

        // add 'tap' event listener, that opens info bubble, to the group
        group.addEventListener('tap', function (evt) {
            // event target is the marker itself, group is a parent event target
            // for all objects that it contains
            var bubble = new H.ui.InfoBubble(evt.target.getPosition(), {
                // read custom data
                content: evt.target.getData()
            });
            // show info bubble
            ui.addBubble(bubble);
        }, false);


    }


    calculateRouteFromAtoB(positionA, positionB,map,ui) {
        self = this;
        // console.log(map);
        var router = this.platform.getRoutingService(),
            routeRequestParams = {
                mode: 'fastest;car',
                representation: 'display',
                routeattributes: 'waypoints,summary,shape,legs',
                maneuverattributes: 'direction,action',
                waypoint0: "" + positionA.latitude +"," + positionA.longitude, // positionA
                waypoint1: "" + positionB.latitude + "," + positionB.longitude  // positionB
            };
        // console.log(router);

        router.calculateRoute(
            routeRequestParams,
            onSuccess,
            onError
        );


        function onSuccess(result) {
            var route = result.response.route[0];
            self.addRouteShapeToMap(route, map);
            self.addManueversToMap(route,map,ui);

            // addWaypointsToPanel(route.waypoint);
            // addManueversToPanel(route);
            // addSummaryToPanel(route.summary);
            // ... etc.
        }

        /**
       * This function will be called if a communication error occurs during the JSON-P request
       * @param  {Object} error  The error message received.
       */
        function onError(error) {
            alert('Ooops!');
        }

        
    }     

    //private function
    //adds route as a polyline
    addRouteShapeToMap(route,map) {
        var lineString = new H.geo.LineString(),
            routeShape = route.shape,
            polyline;

        routeShape.forEach(function (point) {
            var parts = point.split(',');
            lineString.pushLatLngAlt(parts[0], parts[1]);
        });

        polyline = new H.map.Polyline(lineString, {
            style: {
                lineWidth: 4,
                strokeColor: 'rgba(0, 128, 255, 0.7)'
            }
        });
        // Add the polyline to the map
        map.addObject(polyline);
        // And zoom to its bounding rectangle
        map.setViewBounds(polyline.getBounds(), true);
    }

    //private function
    //adds direction bubbles to route
    addManueversToMap(route, map,ui) {
        var bubble;
        var svgMarkup = '<svg width="18" height="18" ' +
            'xmlns="http://www.w3.org/2000/svg">' +
            '<circle cx="8" cy="8" r="8" ' +
            'fill="#1b468d" stroke="white" stroke-width="1"  />' +
            '</svg>',
            dotIcon = new H.map.Icon(svgMarkup, { anchor: { x: 8, y: 8 } }),
            group = new H.map.Group(),
            i,
            j;

        // Add a marker for each maneuver
        for (i = 0; i < route.leg.length; i += 1) {
            for (j = 0; j < route.leg[i].maneuver.length; j += 1) {
                
                // Get the next maneuver.
                var maneuver = route.leg[i].maneuver[j];
                // console.log(maneuver.instruction);
                // Add a marker to the maneuvers group
                var marker = new H.map.Marker({
                    lat: maneuver.position.latitude,
                    lng: maneuver.position.longitude
                },
                    { icon: dotIcon });
                marker.instruction = maneuver.instruction;
                group.addObject(marker);
            }
        }

        group.addEventListener('tap', function (evt) {
            map.setCenter(evt.target.getPosition());
            openBubble(
                evt.target.getPosition(), evt.target.instruction);
        }, false);

        // Add the maneuvers group to the map
        map.addObject(group);



        //helper function to toggle bubble
        function openBubble(position, text){
            if(!bubble){
               bubble =  new H.ui.InfoBubble(
                 position,
                 // The FO property holds the province name.
                 {content: text});
               ui.addBubble(bubble);
             } else {
               bubble.setPosition(position);
               bubble.setContent(text);
               bubble.open();
             }
           }
    }

    configureMapToDragMarker(map,behavior,latId,lngId){
        // disable the default draggability of the underlying map
        // when starting to drag a marker object:
        map.addEventListener('dragstart', function (ev) {
            var target = ev.target;
            if (target instanceof H.map.Marker) {
                behavior.disable();
            }
        }, false);


        // re-enable the default draggability of the underlying map
        // when dragging has completed
        map.addEventListener('dragend', function (ev) {
            var target = ev.target;
            if (target instanceof mapsjs.map.Marker) {
                behavior.enable();
                console.log(target.getPosition().lat,target.getPosition().lng);

                //setting lat lng values to form
                $(`#${latId}`).val(target.getPosition().lat);
                $(`#${lngId}`).val(target.getPosition().lng);

            }
        }, false);

        // Listen to the drag event and move the position of the marker
        // as necessary
        map.addEventListener('drag', function (ev) {
            var target = ev.target,
                pointer = ev.currentPointer;
            if (target instanceof mapsjs.map.Marker) {
                target.setPosition(map.screenToGeo(pointer.viewportX, pointer.viewportY));
            }
        }, false);
    }




//--------------------------------------------------------------------------------------------
//public functions


    //position should be a json object with latitude and longitude as attributes
    showPointAndCenter(position, mapContainerId, label,icon) {

        //initialize a map  - not specificing a location will give a whole world view.
        var map = new H.Map(document.getElementById(mapContainerId), this.defaultLayers.normal.map, { pixelRatio: this.pixelRatio });

        // MapEvents enables the event system
        // Behavior implements default interactions for pan/zoom (also on mobile touch environments)
        var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));

        // Create the default UI components
        var ui = H.ui.UI.createDefault(map, this.defaultLayers);

        //create a group
        var group = new H.map.Group();
        map.addObject(group);

        //add marker to group
        this.addMarkerToGroup(group, position.latitude, position.longitude, label,icon);
        
        //set bubbles
        this.setViewBubblesToGroup(group,ui);

        //center to the marker
        map.setCenter({ lat: position.latitude, lng: position.longitude });
        map.setZoom(13);

    }


    showRouteFromAtoB(positionA,positionB,mapContainerId,routeContainerId=''){
        //initialize a map  - not specificing a location will give a whole world view.
        var map = new H.Map(document.getElementById(mapContainerId), this.defaultLayers.normal.map, { pixelRatio: this.pixelRatio });

        // MapEvents enables the event system
        // Behavior implements default interactions for pan/zoom (also on mobile touch environments)
        var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));

        // Create the default UI components
        var ui = H.ui.UI.createDefault(map, this.defaultLayers);

        //create a group
        var group = new H.map.Group();
        map.addObject(group);
        this.addMarkerToGroup(group,positionA.latitude,positionA.longitude,);
        this.addMarkerToGroup(group,positionB.latitude,positionB.longitude,"","dinner.png");
        this.calculateRouteFromAtoB(positionA,positionB,map,ui);            
    }

    showDraggablePoint(position,mapContainerId,latId,lngId,label='',icon=''){

        //initialize a map  - not specificing a location will give a whole world view.
        var map = new H.Map(document.getElementById(mapContainerId), this.defaultLayers.normal.map, { pixelRatio: this.pixelRatio });

        // MapEvents enables the event system
        // Behavior implements default interactions for pan/zoom (also on mobile touch environments)
        var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));

        // Create the default UI components
        var ui = H.ui.UI.createDefault(map, this.defaultLayers);

        //create a group
        var group = new H.map.Group();
        map.addObject(group);

        //add marker to group
        var marker = this.addMarkerToGroup(group, position.latitude, position.longitude, label,icon);
        marker.draggable = true;
        


        //center to the marker
        map.setCenter({ lat: position.latitude, lng: position.longitude });
        map.setZoom(7);

        this.configureMapToDragMarker(map,behavior,latId,lngId);

    }
}
HMap.instance = null;

