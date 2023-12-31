/*! jquery-locationpicker - v0.1.12 - 2015-01-05 */

! function (a) {
    function b(a, b) {
        var c = new google.maps.Map(a, b),
            d = new google.maps.Marker({
                position: new google.maps.LatLng(54.19335, -3.92695),
                map: c,
                title: "Drag Me",
                draggable: b.draggable
            });
        return {
            map: c,
            marker: d,
            circle: null,
            location: d.position,
            radius: b.radius,
            locationName: b.locationName,
            addressComponents: {
                formatted_address: null,
                addressLine1: null,
                addressLine2: null,
                streetName: null,
                streetNumber: null,
                city: null,
                district: null,
                state: null,
                stateOrProvince: null
            },
            settings: b.settings,
            domContainer: a,
            geodecoder: new google.maps.Geocoder
        }
    }

    function c(a) {
        return void 0 != d(a)
    }

    function d(b) {
        return a(b).data("locationpicker")
    }

    function e(a, b) {
        if (a) {
            var c = h.locationFromLatLng(b.location);
            a.latitudeInput && a.latitudeInput.val(c.latitude).change(), a.longitudeInput && a.longitudeInput.val(c.longitude).change(), a.radiusInput && a.radiusInput.val(b.radius).change(), a.locationNameInput && a.locationNameInput.val(b.locationName).change()
        }
    }

    function f(b, c) {
        b && (b.radiusInput && b.radiusInput.on("change", function (b) {
            b.originalEvent && (c.radius = a(this).val(), h.setPosition(c, c.location, function (a) {
                a.settings.onchanged.apply(c.domContainer, [h.locationFromLatLng(a.location), a.radius, !1])
            }))
        }), b.locationNameInput && c.settings.enableAutocomplete && (c.autocomplete = new google.maps.places.Autocomplete(b.locationNameInput.get(0)), google.maps.event.addListener(c.autocomplete, "place_changed", function () {
            var a = c.autocomplete.getPlace();
            return a.geometry ? void h.setPosition(c, a.geometry.location, function (a) {
                e(b, a), a.settings.onchanged.apply(c.domContainer, [h.locationFromLatLng(a.location), a.radius, !1])
            }) : void c.settings.onlocationnotfound(a.name)
        })), b.latitudeInput && b.latitudeInput.on("change", function (b) {
            b.originalEvent && h.setPosition(c, new google.maps.LatLng(a(this).val(), c.location.lng()), function (a) {
                a.settings.onchanged.apply(c.domContainer, [h.locationFromLatLng(a.location), a.radius, !1])
            })
        }), b.longitudeInput && b.longitudeInput.on("change", function (b) {
            b.originalEvent && h.setPosition(c, new google.maps.LatLng(c.location.lat(), a(this).val()), function (a) {
                a.settings.onchanged.apply(c.domContainer, [h.locationFromLatLng(a.location), a.radius, !1])
            })
        }))
    }

    function g(a) {
        google.maps.event.trigger(a.map, "resize"), setTimeout(function () {
            a.map.setCenter(a.marker.position)
        }, 300)
    }
    var h = {
        drawCircle: function (b, c, d, e) {
            return null != b.circle && b.circle.setMap(null), d > 0 ? (d *= 1, e = a.extend({
                strokeColor: "#0000FF",
                strokeOpacity: .35,
                strokeWeight: 2,
                fillColor: "#0000FF",
                fillOpacity: .2
            }, e), e.map = b.map, e.radius = d, e.center = c, b.circle = new google.maps.Circle(e), b.circle) : null
        },
        setPosition: function (a, b, c) {
            a.location = b, a.marker.setPosition(b), a.map.panTo(b), this.drawCircle(a, b, a.radius, {}), a.settings.enableReverseGeocode ? a.geodecoder.geocode({
                latLng: a.location
            }, function (b, d) {
                d == google.maps.GeocoderStatus.OK && b.length > 0 && (a.locationName = b[0].formatted_address, a.addressComponents = h.address_component_from_google_geocode(b[0].address_components)), c && c.call(this, a)
            }) : c && c.call(this, a)
        },
        locationFromLatLng: function (a) {
            return {
                latitude: a.lat(),
                longitude: a.lng()
            }
        },
        address_component_from_google_geocode: function (a) {
            for (var b = {}, c = a.length - 1; c >= 0; c--) {
                var d = a[c];
                d.types.indexOf("postal_code") >= 0 ? b.postalCode = d.short_name : d.types.indexOf("street_number") >= 0 ? b.streetNumber = d.short_name : d.types.indexOf("route") >= 0 ? b.streetName = d.short_name : d.types.indexOf("locality") >= 0 ? b.city = d.short_name : d.types.indexOf("sublocality") >= 0 ? b.district = d.short_name : d.types.indexOf("administrative_area_level_1") >= 0 ? b.stateOrProvince = d.short_name : d.types.indexOf("country") >= 0 && (b.country = d.short_name)
            }
            return b.addressLine1 = [b.streetNumber, b.streetName].join(" ").trim(), b.addressLine2 = "", b
        }
    };
    a.fn.locationpicker = function (i, j) {
        if ("string" == typeof i) {
            var k = this.get(0);
            if (!c(k)) return;
            var l = d(k);
            switch (i) {
                case "location":
                    if (void 0 == j) {
                        var m = h.locationFromLatLng(l.location);
                        return m.radius = l.radius, m.name = l.locationName, m
                    }
                    j.radius && (l.radius = j.radius), h.setPosition(l, new google.maps.LatLng(j.latitude, j.longitude), function (a) {
                        e(a.settings.inputBinding, a)
                    });
                    break;
                case "subscribe":
                    if (void 0 == j) return null;
                    var n = j.event,
                        o = j.callback;
                    if (!n || !o) return console.error('LocationPicker: Invalid arguments for method "subscribe"'), null;
                    google.maps.event.addListener(l.map, n, o);
                    break;
                case "map":
                    if (void 0 == j) {
                        var p = h.locationFromLatLng(l.location);
                        return p.formattedAddress = l.locationName, p.addressComponents = l.addressComponents, {
                            map: l.map,
                            marker: l.marker,
                            location: p
                        }
                    }
                    return null;
                case "autosize":
                    return g(l), this
            }
            return null
        }
        return this.each(function () {
            var d = a(this);
            if (!c(this)) {
                var g = a.extend({}, a.fn.locationpicker.defaults, i),
                    j = new b(this, {
                        zoom: g.zoom,
                        center: new google.maps.LatLng(g.location.latitude, g.location.longitude),
                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                        mapTypeControl: !1,
                        disableDoubleClickZoom: !1,
                        scrollwheel: g.scrollwheel,
                        streetViewControl: !1,
                        radius: g.radius,
                        locationName: g.locationName,
                        settings: g,
                        draggable: g.draggable
                    });
                d.data("locationpicker", j), google.maps.event.addListener(j.marker, "dragend", function () {
                    h.setPosition(j, j.marker.position, function (a) {
                        var b = h.locationFromLatLng(j.location);
                        a.settings.onchanged.apply(j.domContainer, [b, a.radius, !0]), e(j.settings.inputBinding, j)
                    })
                }), h.setPosition(j, new google.maps.LatLng(g.location.latitude, g.location.longitude), function (a) {
                    e(g.inputBinding, j), f(g.inputBinding, j), a.settings.oninitialized(d)
                })
            }
        })
    }, a.fn.locationpicker.defaults = {
        location: {
            latitude: 40.7324319,
            longitude: -73.82480799999996
        },
        locationName: "",
        radius: 500,
        zoom: 15,
        scrollwheel: !0,
        inputBinding: {
            latitudeInput: null,
            longitudeInput: null,
            radiusInput: null,
            locationNameInput: null
        },
        enableAutocomplete: !1,
        enableReverseGeocode: !0,
        draggable: !0,
        onchanged: function () {},
        onlocationnotfound: function () {},
        oninitialized: function () {}
    }
}(jQuery);
//# sourceMappingURL=locationpicker.jquery.min.map
