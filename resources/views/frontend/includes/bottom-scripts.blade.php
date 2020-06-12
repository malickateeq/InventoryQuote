<!-- Index scripts -->

<script type="text/javascript">

        $.getScript("https://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places&amp;callback=initialize&amp;language=en&amp;key=AIzaSyApbQ2FwluM5P4SLKdso5Vkk8zuLTnOzQI");

        function initialize() {
            $("#addr_from, #addr_to").autocomplete({
                autoFocus: true,
                minLength: 1
            }, {
                source: function(request, response) {
                    var input = $(this.element).val();
                    $.ajax({
                        type: 'POST',
                        url: 'https://www.searates2.com/search/google-autocomplete',
                        dataType: 'json',
                        data: {
                            input: input
                        },
                        mode: 'abort',
                        minLength: 2,
                        success: function(data) {
                            $('.ui-autocomplete-input').removeClass('ui-autocomplete-loading');
                            response(data);
                        }
                    });
                },
                change: function(event, ui) {
                    if (ui.item == undefined) {
                        $(this).parent().find('[name="from"], [name="to"]').val('');
                        $(this).val('');
                    }
                },
                select: function(event, ui) {
                    var oldThis = this;
                    $.ajax({
                        type: 'POST',
                        url: 'https://www.searates2.com/search/google-geocode',
                        dataType: 'json',
                        data: {
                            input: ui.item.place_id,
                            type: 'place_id'
                        },
                        mode: 'abort',
                        success: function(result) {
                            $.map(result.results, function(item) {
                                var a_c = item.address_components;
                                var country = a_c[a_c.length - 1];
                                for (var i in a_c) {
                                    if ($.inArray('country', a_c[i]['types']) != -1 && $.inArray('political', a_c[i]['types']) != -1) country = a_c[i];
                                }
                                if (!isNaN(parseInt(country.short_name))) country.short_name = (country.short_name >= 95000 && country.short_name <= 99804 ? 'UA' : country.short_name);
                                $(oldThis).parent().find('[name="from"], [name="to"]').val(ui.item.place_id).trigger('change');;
                                $(oldThis).val(ui.item.city + ', ' + ((ui.item.region != null) ? (ui.item.region + ', ') : '') + ui.item.country);
                                return {
                                    country_code: country.short_name,
                                    city_name: a_c[0].long_name,
                                    label: item.formatted_address,
                                    value: item.formatted_address,
                                    latitude: item.geometry.location.lat,
                                    longitude: item.geometry.location.lng,
                                    place_id: item.place_id
                                };
                            })
                        }
                    });
                }
            }).each(function() {
                $(this).data("ui-autocomplete")._renderItem = function(ul, item) {
                    $('.ui-autocomplete-input').removeClass('ui-autocomplete-loading');
                    var htm = '<i class="flag-icon flag-icon-' + item.counrty_code.toLowerCase() + '"></i><a>' + item.city + ', ' + ((item.region != null) ? (item.region + ', ') : '') + item.country + "</a>";
                    return $("<li></li>").data("item.autocomplete", item).append(htm).appendTo(ul);
                };
            });
        }
        $(document).ready(function() 
        {
            $('.btn-route').on('click', function() {
                $('.route-active').removeClass('route-active');
                $(this).addClass('route-active');
                var mode = $(this).data('mode');
                $('.dropdown-shipment li').hide();
                $('.dropdown-shipment li:has([data-mode="' + mode + '"])').show().find('a').first().click();
                var type = $(this).data('type');
                console.log( $(this).data().mode );
                $("#transportation_type").val( $(this).data().mode );
                $('.type-delivery-active').removeClass('type-delivery-active');
                $('.type-' + type + '-item').addClass('type-delivery-active');
            });
            $('.route-list [data-mode="sea"]').click();
            $('.dropdown-shipment li > a').on('click', function() {
                CURRENT_MODE = $(this).data('mode');
                CURRENT_TYPE = $(this).data('type');
                var angle = (CURRENT_TYPE === 'air' || CURRENT_TYPE === 'rail') ? '' : '<i class="fal fa-angle-down"></i>';
                $('#weight_cargo').val(CURRENT_TYPE === 'bulk' ? 1 : 100);
                $('.dropdown-shipment > a').html($(this).html() + angle);
                var type = $(this).data('type');
                $('.filter-shipping [name="type"]').val(type);
            });
            let date_filter = new Date();
            let date_before = date_filter > new Date() ? new Date() : date_filter;
            $('.date-day').datepicker({
                autoclose: true,
                container: '.date-field',
                startDate: date_before
            }).datepicker('update', date_filter);
            $('.application-switch ul').on('click', 'li', function(event) {
                $(this).addClass('active').siblings().removeClass('active');
                if ($(this).hasClass('switch-freight')) {
                    $('.filter-shipping, .title-shipping', ).addClass('active');
                    $('.filter-tracking, .title-tracking').removeClass('active');
                } else {
                    $('.filter-shipping, .title-shipping').removeClass('active');
                    $('.filter-tracking, .title-tracking').addClass('active');
                }
            });
            $('.swap-places').on('click', function() {
                var addr = $('#addr_from').val();
                var id = $('#addr_from_id').val();
                var lat = $('#lat_from').val();
                var lng = $('#lng_from').val();
                $('#addr_from').val($('#addr_to').val());
                $('#addr_from_id').val($('#addr_to_id').val());
                $('#lat_from').val($('#lat_to').val());
                $('#lng_from').val($('#lng_to').val());
                $('#addr_to').val(addr);
                $('#addr_to_id').val(id);
                $('#lat_to').val(lat);
                $('#lng_to').val(lng);
            });
            $('#select-two').select2();
        }); 
    </script>
    <script type="text/javascript">
        let PREFIXES = [{
            "tracking_id": 1,
            "name": "MSC",
            "code": ["GTI", "MED", "MSC", "MSD", "MSM", "MSP", "MSY", "MSZ", "SVS"]
        }, {
            "tracking_id": 2,
            "name": "ARKAS",
            "code": ["ARK"]
        }, {
            "tracking_id": 4,
            "name": "HAMBURG SUD",
            "code": ["HAS", "SUD"]
        }, {
            "tracking_id": 5,
            "name": "COSCO",
            "code": ["CCL", "CSL", "CSN"]
        }, {
            "tracking_id": 6,
            "name": "EVERGREEN",
            "code": ["EGH", "EGS", "EIS", "ENC", "HMC"]
        }, {
            "tracking_id": 7,
            "name": "HAPAG-LLOYD",
            "code": ["AZL", "CAS", "CMU", "CPS", "CSQ", "CSV", "FAN", "HAM", "HLB", "HLC", "HLX", "ITA", "IVL", "LBI", "LNX", "LYK", "MOM", "QIB", "QNN", "TLE", "TMM", "UAC", "UAE", "UAS"]
        }, {
            "tracking_id": 10,
            "name": "MAERSK",
            "code": ["APM", "COZ", "FAA", "FRL", "KNL", "LOT", "MAE", "MAL", "MCA", "MCH", "MCI", "MCR", "MEA", "MGB", "MHH", "MIE", "MMA", "MNB", "MRK", "MRS", "MSA", "MSF", "MSK", "MSW", "MVI", "MWC", "MWM", "OCL", "POC", "PON", "SCM", "TOR"]
        }, {
            "tracking_id": 13,
            "name": "ZIM",
            "code": ["ZCL", "ZCS", "ZIM", "ZMO", "ZWF"]
        }, {
            "tracking_id": 14,
            "name": "APL",
            "code": ["APD", "APH", "API", "APL", "APR", "APZ"]
        }, {
            "tracking_id": 15,
            "name": "CMA CGM",
            "code": ["AMC", "CGH", "CGM", "CGT", "CMA", "CMN", "CNC", "DVR", "ECM", "MCU", "NEP", "NOL", "NOS", "NUS", "OPD", "OTA", "STM"]
        }, {
            "tracking_id": 17,
            "name": "OOCL",
            "code": ["OOC", "OOL"]
        }, {
            "tracking_id": 18,
            "name": "YANG MING",
            "code": ["KMS", "YML", "YMM"]
        }, {
            "tracking_id": 23,
            "name": "PIL",
            "code": ["PIL"]
        }, {
            "tracking_id": 69,
            "name": "TURKON",
            "code": ["TRK"]
        }, {
            "tracking_id": 88,
            "name": "ONE",
            "code": ["ONE", "NYK", "AKL", "EKL", "ESS", "KKF", "KKL", "KKT", "KLF", "KLT", "KPP", "KXT", "PXC", "MCG", "MOA", "MOE", "MOF", "MOG", "MOL", "MOR", "MOS", "MOT", "NHC"]
        }, {
            "tracking_id": 97,
            "name": "WAN HAI",
            "code": ["WHL"]
        }, {
            "tracking_id": 104,
            "name": "HYUNDAI",
            "code": ["HAM", "HDM", "HMM", "HMR"]
        }, {
            "tracking_id": 111,
            "name": "SAFMARINE",
            "code": [""]
        }, {
            "tracking_id": 112,
            "name": "SEALAND",
            "code": [""]
        }, {
            "tracking_id": 124,
            "name": "SINOKOR",
            "code": ["SKH", "SKL", "SKR", "SKS"]
        }];
        $.fn.simpleSpy = function() {
            limit = 5;
            return this.each(function() {
                var $list = $(this),
                    running = true,
                    items = [],
                    currentItem = 9;
                $list.find('> li').each(function() {
                    items.push('<li>' + $(this).html() + '</li>');
                });
                $list.find('> li').filter(':gt(' + (limit - 1) + ')').remove();
                $list.bind('stop', function() {
                    running = false;
                }).bind('start', function() {
                    running = true;
                });

                function spy() {
                    if (running) {
                        var $insert = $(items[currentItem]).css({
                            height: 0,
                            opacity: 0
                        }).prependTo($list);
                        $list.find('> li:last').animate({
                            opacity: 0
                        }, 0, function() {
                            $(this).animate({
                                height: 0
                            }, 0, function() {
                                $(this).remove();
                            });
                        });
                        $insert.animate({
                            opacity: 1
                        }, 1).animate({
                            height: 33
                        }, 500);
                        currentItem--;
                        if (currentItem < 0) {
                            currentItem = 9;
                        }
                    }
                    setTimeout(spy, 4500);
                }
                spy();
            });
        };

        function parallax(el, speed, reverse, rotate, horizontal) {
            var viewport = $(window),
                scrollPos = viewport.scrollTop();
            if (rotate == false && horizontal == false) {
                if (reverse == false) {
                    el.css('transform', 'translateY(' + scrollPos / speed + 'px)');
                } else {
                    el.css('transform', 'translateY(' + -scrollPos / speed + 'px)');
                }
            } else if (horizontal == false) {
                el.css('transform', 'rotate(-' + scrollPos / speed + 'deg)');
            } else if (horizontal == true) {
                el.css('transform', 'translateX(' + -scrollPos / speed + 'px)');
            }
        }
        if ($(window).width() >= 992) {
            $(document).scroll(function() {
                parallax($('.item-block.b2b-block .image-block img.step-img'), 7, true, false, true);
                parallax($('.item-block.load-calc .image-block img'), 50, true, false, false);
                parallax($('.item-block.load-calc .image-block img.front-img'), 12, false, false, false);
                parallax($('.item-block.freight img'), 40, true, false, false);
                parallax($('.item-block.sell-block img'), 40, true, false, false);
                parallax($('.item-block.log-exp img'), 40, false, false, false);
                parallax($('.item-block.multi-track img'), 40, true, false, false);
            });
        }
        $(document).ready(function() {
            $('ul.leadsCycleContainer_exchange').simpleSpy().bind('mouseenter', function() {
                $(this).trigger('stop');
            }).bind('mouseleave', function() {
                $(this).trigger('start');
            });
            var showTitle = function() {
                window.onscroll = function() {
                    var showTitleWh = window.pageYOffset;
                    var hiddenTitle = true;
                    if (showTitleWh >= 100 && hiddenTitle === true) {
                        $('.filter_controls h2.hps').addClass('active');
                        hiddenTitle = false;
                    }
                };
            };
            showTitle();
        });
    </script>
<!-- ! Index scripts -->