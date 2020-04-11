<template>
    <div>
        <div class="google-map" ref="googleMap">
        </div>
        <template v-if="Boolean(this.google) && Boolean(this.map)">
            <slot
                    :google="google"
                    :map="map"
            />
        </template>
    </div>
</template>
<script>
    import GoogleMapsApiLoader from 'google-maps-api-loader'

    export default {
        props: {
            mapConfig: Object,
            apiKey: String,
        },
        data: function () {
            return {
                google: null,
                map: null
            }
        },
        async mounted() {
            this.google = await GoogleMapsApiLoader({
                apiKey: this.apiKey
            });
            this.initializeMap();
            console.log(this.google);
            console.log(this.map);
        },

        methods: {
            initializeMap() {
                const mapContainer = this.$refs.googleMap;
                this.map = new this.google.maps.Map(mapContainer, {
                    center: { lat: 3, lng: 101 },
                    zoom: 12,

                })
            }
        }
    }
</script>