<template>
    <GoogleMapLoader
            :mapConfig="mapConfig"
            apiKey="AIzaSyAmHh2gluvEpciOs4SPJDn1j-AqeVi5v8I"
    >
        <template slot-scope="{ google, map }">
            <GoogleMapMarker
                    v-for="marker in markers"
                    :key="marker.id"
                    :marker="marker"
                    :google="google"
                    :map="map"
            />
        </template>
    </GoogleMapLoader>
</template>

<script>
    import GoogleMapLoader from "./GoogleMapLoader";
    import GoogleMapMarker from "./GoogleMapMarker";

    export default {
        components: {
            GoogleMapLoader,
            GoogleMapMarker,
        },
        data: function () {
            return {
                markers: [
                    { id: 'a', position: { lat: 3, lng: 101 } },
                    { id: 'b', position: { lat: 5, lng: 99 } },
                    { id: 'c', position: { lat: 6, lng: 97 } },
                ],
            }
        },

        computed: {
            mapConfig () {
                return {
                    center: this.mapCenter
                }
            },

            mapCenter () {
                return this.markers[1].position
            }
        },
    }
</script>