@extends('frontend.layouts.app')
@section('content')

<div class="app-wrapper container">
    <div class="shipping-form" style="display: inline-block;">
        <form action="{{ route('form_quote_step2') }}" method="POST">
            @csrf
            <h2>Type of delivery</h2>
            <div class="shipment-type" style="margin: 20px 0px;">
                <div class="item">
                    <div class="icon"><i class="fad fa-boxes"></i></div>
                    <p>lcl</p>
                </div>
                <div class="item active">
                    <div class="icon"><i class="fad fa-container-storage"></i></div>
                    <p>fcl</p>
                </div>
                <!-- <div class="item">
                    <div class="icon"><i class="fad fa-mountains"></i></div>
                    <p>bulk</p>
                </div> -->
                <input type="hidden" name="type" value="lcl">
            </div>

            <h2>Description Of Goods</h2>
            <div class="shipment-form">

                <div class="from-row">
                    <div class="request-input large">
                        <p class="name">Value of the goods in USD</p>
                        <div class="input-wrap  ">
                            <input type="number" title="Value of goods" name="value_of_goods"
                                placeholder="Value of goods (USD)" step="any" autocomplete="off" required="" value="">
                        </div>
                    </div>
                </div>

                <div class="from-row">
                    <div class="request-input large">
                        <p class="name">Number of containers</p>
                        <div class="input-wrap  ">
                            <input type="number" title="Number of containers" name="no_of_containers"
                                placeholder="Value of goods (USD)" step="any" autocomplete="off" required="" value="">
                        </div>
                    </div>
                </div>

                <div class="request-select large">
                    <p class="label">Size of containers</p>
                    <div class="select-wrap  blue"><select name="container_size" required="">
                            <option></option>
                            <option value="20f">20 feet</option>
                            <option value="40f">40 feet</option>
                            <option value="40f_hc">40 feet HC</option>
                        </select></div>
                </div>

                <div class="form-row">

                    <div class="request-cascader">
                        <label class="request-toggle">
                            <p class="label">Stockable Shipment</p>
                            <div class="toggle-wrap">
                                <input type="checkbox" name="isStockable" value="yes">
                                <div class="toggle-content">
                                    <span class="toggler" style="background: rgb(243, 156, 1);"></span>
                                    <div class="values">
                                        <p>No</p>
                                        <p>Yes</p>
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>

                    <label class="request-toggle">
                        <p class="label">DGR Shipment</p>
                        <div class="toggle-wrap">
                            <input type="checkbox" name="isDGR" value="yes">
                            <div class="toggle-content">
                                <span class="toggler" style="background: rgb(243, 156, 1);"></span>
                                <div class="values">
                                    <p>No</p>
                                    <p>Yes</p>
                                </div>
                            </div>
                        </div>
                    </label>
                </div>
            </div>

            <h2>Shipment Calculations</h2>
            <div class="shipment-form">
                <div class="type-form">

                    <div class="request-radio-group">
                        <label class="request-radio blue calculation-toggle">
                            <input type="radio" name="calculate_by" value="shipment" checked="">
                            <span></span>
                            <p>Calculate by total shipment</p>
                        </label>
                        <label class="request-radio blue calculation-toggle">
                            <input type="radio" name="calculate_by" value="units"><span></span>
                            <p>Calculate by units</p>
                        </label>
                    </div>

                    <div class="form-row" id="shipment">
                        <div class="request-input small">
                            <p class="name">Volume</p>
                            <div class="input-wrap  ">
                                <input type="number" title="Volume" name="gross_vol" placeholder="0" step="any"
                                    autocomplete="off" required="" value="">
                                <p class="label">CBM</p>
                            </div>
                        </div>
                        <div class="request-input small">
                            <p class="name">Gross Weight</p>
                            <div class="input-wrap  "><input type="number" title="Gross Weight" name="cargo_weight"
                                    placeholder="0" step="any" autocomplete="off" required="" value="">
                                <p class="label">Mt</p>
                            </div>
                        </div>
                    </div>

                    <div class="form-row" id="units">
                        <div class="request-input small">
                            <p class="name">Quantity</p>
                            <div class="input-wrap  "><input type="number" title="Quantity" name="quantity"
                                    placeholder="" step="any" autocomplete="off" required="" value=""></div>
                        </div>
                        <div class="dimensions">
                            <div class="request-input small">
                                <p class="name">Dimensions</p>
                                <div class="input-wrap  "><input type="number" title="Dimensions" name="l"
                                        placeholder="L" step="any" autocomplete="off" required="" value=""></div>
                            </div>
                            <div class="request-input small">
                                <p class="name"> </p>
                                <div class="input-wrap  "><input type="number" title=" " name="w" placeholder="W"
                                        step="any" autocomplete="off" required="" value=""></div>
                            </div>
                            <div class="request-input small">
                                <p class="name"> </p>
                                <div class="input-wrap  "><input type="number" title=" " name="h" placeholder="H"
                                        step="any" autocomplete="off" required="" value="">
                                    <p class="label">CM</p>
                                </div>
                            </div>
                        </div>
                        <div class="request-input small">
                            <p class="name">Gross Weight</p>
                            <div class="input-wrap  ">
                                <input type="number" title="Gross Weight" name="gross_weight" placeholder="" step="any"
                                    autocomplete="off" disabled="" value="">
                                <p class="label">Mt</p>
                            </div>
                        </div>
                    </div>

                    <div class="shipment-total">
                        <p>Shipment total: <span id="cbn">0</span> CBM <span id="kg">0</span> kg</p>
                    </div>

                </div>
            </div>


            <h2>Other Info</h2>
            <div class="shipment-form">

                <div class="from-row">
                    <div class="request-input large">
                        <p class="name">Remarks</p>
                        <div class="input-wrap  ">
                            <textarea name="remarks" id="" cols="45" rows="3"
                                style="border-radius: 5px; border: 1px solid gray;"></textarea>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="request-cascader">
                        <label class="request-toggle">
                            <p class="label">Reqires customs clearance?</p>
                            <div class="toggle-wrap">
                                <input type="checkbox" name="isClearanceReq" value="yes">
                                <div class="toggle-content">
                                    <span class="toggler" style="background: rgb(243, 156, 1);"></span>
                                    <div class="values">
                                        <p>No</p>
                                        <p>Yes</p>
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <div class="request-footer">
                <div class="btns">
                    <!-- <button type="submit" class="request-btn prev disabled"
                        style="background: rgb(243, 156, 1);">
                        <i class="fal fa-angle-left"></i>
                    </button> -->
                    <button type="submit" class="request-btn next " style="background: rgb(243, 156, 1);">
                        <span>Next</span>
                        <i class="fal fa-angle-right"></i>
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#units').hide();
        $("input[name=quantity]").prop('required', false);
        $("input[name=l]").prop('required', false);
        $("input[name=w]").prop('required', false);
        $("input[name=h]").prop('required', false);
        $("input[name=gross_weight]").prop('required', false);

        // On calculation radio button clicks
        $('input:radio').change(function () {
            var el = $(this).val();
            if (el == 'units') {
                $('#units').show();
                $('#shipment').hide();

                $("input[name=gross_vol]").prop('required', false);
                $("input[name=cargo_weight]").prop('required', false);
            } else {
                $('#units').hide();
                $('#shipment').show();

                $("input[name=quantity]").prop('required', false);
                $("input[name=l]").prop('required', false);
                $("input[name=w]").prop('required', false);
                $("input[name=h]").prop('required', false);
                $("input[name=gross_weight]").prop('required', false);
            }
        });


        // Live results on calculations
        $("input[name=gross_vol], input[name=cargo_weight], input[name=quantity], input[name=l], input[name=w], input[name=h], input[name=gross_weight]")
            .keyup(function () {
                var el = $(this).attr("name");
                if (el == 'gross_vol') {
                    if ($(this).val() == "") {
                        $("#cbn").text('1');
                    } else {
                        $("#cbn").text($(this).val());
                    }
                } else if (el == 'cargo_weight') {
                    if ($(this).val() == "") {
                        $("#kg").text('1');
                    } else {
                        $("#kg").text($(this).val());
                    }
                }

                // For units
                else {
                    var quantity = $('input[name=quantity]').val() ? parseFloat($('input[name=quantity]')
                        .val()) : 1;
                    var l = $('input[name=l]').val() ? parseFloat($('input[name=l]').val()) : 1;
                    var w = $('input[name=w]').val() ? parseFloat($('input[name=w]').val()) : 1;
                    var h = $('input[name=h]').val() ? parseFloat($('input[name=h]').val()) : 1;
                    // var gross_weight = $('input[name=gross_weight]').val() ? parseFloat( $('input[name=gross_weight]').val() ) : 1;

                    var vol_weight = (l * w * h) / 6000 * quantity;
                    $('input[name=gross_weight]').val(vol_weight);
                    $("#kg").text(vol_weight);
                }
            });

    });

</script>

@endsection
