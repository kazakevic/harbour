<template>
    <div style="height: 500px; width: 100%">
        <l-map
                v-if="showMap"
                :zoom="zoom"
                :center="center"
                :options="mapOptions"
                style="height: 80%"
                @update:center="centerUpdate"
                @update:zoom="zoomUpdate"
        >
            <l-tile-layer
                    :url="url"
                    :attribution="attribution"
            />
            <div v-for="marker in markers">
                <l-marker :lat-lng="marker" :icon="icon">
                    <l-popup>
                        <div>
                            Weather
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque
                                sed pretium nisl, ut sagittis sapien. Sed vel sollicitudin nisi.
                                Donec finibus semper metus id malesuada.
                            </p>
                        </div>
                    </l-popup>
                </l-marker>
            </div>
        </l-map>
    </div>
</template>

<script>
    import { latLng, icon } from "leaflet";
    import { LMap, LTileLayer, LMarker, LPopup, LTooltip} from "vue2-leaflet";
    import axios from "axios"
    export default {
        name: "Example",
        components: {
            LMap,
            LTileLayer,
            LMarker,
            LPopup,
            LTooltip
        },
        data() {
            return {
                zoom: 2,
                center: latLng(47.41322, -1.219482),
                url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                attribution:
                    '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                currentZoom: 11.5,
                currentCenter: latLng(14.5617, 121.0214),
                showParagraph: false,
                mapOptions: {
                    zoomSnap: 0.5
                },
                showMap: true,
                markers: [],
                icon: icon({
                    iconUrl:'pngfuel.com.png',
                    iconSize: [20, 20],
                    iconAnchor: [16, 37]
                }),
            };
        },
        methods: {
            zoomUpdate(zoom) {
                this.currentZoom = zoom;
            },
            centerUpdate(center) {
                this.currentCenter = center;
            },
            getHarbours() {
                axios
                    .get('https://devapi.harba.co/harbors/visible')
                    .then(response => {
                        response.data.forEach(harbour =>
                            this.markers.push(
                                latLng(harbour.lat, harbour.lon)
                            )
                        );
                        this.currentCenter = this.markers[0]
                    })
                    .catch(error => {
                        console.log(error);
                        this.errored = true
                    })
            }
        },
        mounted() {
            this.getHarbours();
            // this.$nextTick(() => {
            //     this.$refs.myMap.mapObject.setIcon('pngfuel.com.png');
            // });
        },
    };
</script>
