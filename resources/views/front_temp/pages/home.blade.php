@extends('front.base')
@section('contents')
<div class="post_content entry-content">
    <div
        data-elementor-type="wp-page"
        data-elementor-id="36704"
        class="elementor elementor-36704">
        <section
            class="elementor-section elementor-top-section elementor-element elementor-element-3b86507 elementor-section-boxed elementor-section-height-default elementor-section-height-default sc_fly_static"
            data-id="3b86507"
            data-element_type="section">
            <div class="elementor-container elementor-column-gap-extended">
                <div
                    class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-b16d9a7 sc_inner_width_none sc_content_align_inherit sc_layouts_column_icons_position_left sc_fly_static"
                    data-id="b16d9a7"
                    data-element_type="column">
                    <div class="elementor-widget-wrap elementor-element-populated">
                        <div
                            class="elementor-element elementor-element-a044b3c sc_fly_static elementor-widget elementor-widget-trx_widget_slider"
                            data-id="a044b3c"
                            data-element_type="widget"
                            data-widget_type="trx_widget_slider.default">
                            <div class="elementor-widget-container">
                                <div class="widget_area sc_widget_slider">
                                    <aside class="widget widget_slider">
                                        <div class="slider_wrap slider_engine_revo slider_alias_slider-6">
                                            <div class="wp-block-themepunch-revslider 0">
                                                <!-- START Slider 6 REVOLUTION SLIDER 6.7.9 -->
                                                <p class="rs-p-wp-fix"></p>
                                                <rs-module-wrap
                                                    id="rev_slider_10_1_wrapper"
                                                    data-source="gallery"
                                                    style="visibility:hidden;background:transparent;padding:0;">
                                                    <rs-module id="rev_slider_10_1" style="" data-version="6.7.9">
                                                        <rs-slides style="overflow: hidden; position: absolute;">
                                                            @php $no=1; @endphp @foreach($dataslider as $rowslider) @php $vno=$no++; @endphp
                                                            <rs-slide
                                                                style="position: absolute;"
                                                                data-key="rs-{{ $vno }}"
                                                                data-title="Slide"
                                                                data-thumb="{{ $rowslider->images }}"
                                                                data-anim="ms:1000ms;"
                                                                data-in="o:0;"
                                                                data-out="a:false;">
                                                                <img
                                                                    loading="lazy"
                                                                    decoding="async"
                                                                    src="{{ $rowslider->images }}"
                                                                    alt=""
                                                                    title="242_6-1-copyright"
                                                                    width="1920"
                                                                    height="980"
                                                                    class="rev-slidebg tp-rs-img rs-lazyload"
                                                                    data-lazyload="{{ $rowslider->images }}"
                                                                    data-bg="p:45% 30%;"
                                                                    data-parallax="off"
                                                                    data-panzoom="d:10000;ss:100;se:110%;"
                                                                    data-no-retina="data-no-retina">
                                                                    <!-- -->
                                                                    <rs-zone id="rrzb_{{ $vno }}" class="rev_row_zone_bottom" style="z-index: 4;">
                                                                        <!-- -->
                                                                        <rs-row
                                                                            id="slider-10-slide-11-layer-13"
                                                                            data-type="row"
                                                                            data-xy="xo:50px;yo:50px;"
                                                                            data-cbreak="nobreak"
                                                                            data-basealign="slide"
                                                                            data-wrpcls="slider-row-wrap"
                                                                            data-rsp_bd="off"
                                                                            data-margin="b:100,60,40,40;"
                                                                            data-frame_0="o:1;"
                                                                            data-frame_999="o:0;st:w;sR:8700;sA:9000;"
                                                                            style="z-index:6;">
                                                                            <!-- -->
                                                                            <rs-column
                                                                                id="slider-10-slide-11-layer-14"
                                                                                data-type="column"
                                                                                data-xy="xo:50px;yo:50px;"
                                                                                data-text="l:20,24,24,24;a:center;"
                                                                                data-rsp_bd="off"
                                                                                data-column="w:100%;"
                                                                                data-frame_0="o:1;"
                                                                                data-frame_999="o:0;st:w;sR:8700;sA:9000;"
                                                                                style="z-index:6;width:100%;">
                                                                                <!-- -->
                                                                                <rs-layer
                                                                                    id="slider-10-slide-11-layer-1"
                                                                                    data-type="text"
                                                                                    data-color="#efe8ce"
                                                                                    data-xy=""
                                                                                    data-pos="r"
                                                                                    data-text="w:normal;s:16,14,13,13;l:26,16,16,16;ls:2px;fw:500;a:center;"
                                                                                    data-rsp_o="off"
                                                                                    data-rsp_bd="off"
                                                                                    data-disp="inline-block"
                                                                                    data-border="bos:solid;bow:2px,2px,2px,2px;"
                                                                                    data-frame_0="x:30px,26px,20px,20px;y:0,0px,0px,0px;"
                                                                                    data-frame_1="x:0,0px,0px,0px;y:0,0px,0px,0px;st:370;sp:1000;sR:370;"
                                                                                    data-frame_999="o:0;st:w;sR:7630;"
                                                                                    style="z-index:13;font-family:'roc-grotesk';text-transform:uppercase;display:inline-block;">{{ $rowslider->description }}
                                                                                </rs-layer>
                                                                                <!-- -->
                                                                                <rs-layer
                                                                                    id="slider-10-slide-11-layer-0"
                                                                                    data-type="shape"
                                                                                    data-rsp_ch="on"
                                                                                    data-xy=""
                                                                                    data-pos="r"
                                                                                    data-text="w:normal;s:20,15,8,4;c:both;l:0,18,9,6;"
                                                                                    data-flcr="c:both;"
                                                                                    data-dim="w:100%;h:12px,12px,12px,8px;"
                                                                                    data-frame_999="o:0;st:w;sR:8700;"
                                                                                    style="z-index:12;"></rs-layer>
                                                                                <!-- -->
                                                                                <rs-layer
                                                                                    id="slider-10-slide-11-layer-24"
                                                                                    data-type="text"
                                                                                    data-color="#efe8ce"
                                                                                    data-xy=""
                                                                                    data-pos="r"
                                                                                    data-text="w:normal;s:140,105,79,70;l:130,98,74,65;ls:-1px;fw:500;a:center;"
                                                                                    data-rsp_o="off"
                                                                                    data-disp="inline-block"
                                                                                    data-frame_0="x:40px,30px,23px,20px;y:0,0px,0px,0px;"
                                                                                    data-frame_1="x:0,0px,0px,0px;y:0,0px,0px,0px;st:580;sp:1000;sR:580;"
                                                                                    data-frame_999="o:0;st:w;sR:7420;"
                                                                                    style="z-index:11;font-family:'roc-grotesk';display:inline-block;">{{ $rowslider->title }}
                                                                                </rs-layer>
                                                                                <!-- -->
                                                                                <rs-layer
                                                                                    id="slider-10-slide-11-layer-19"
                                                                                    data-type="shape"
                                                                                    data-rsp_ch="on"
                                                                                    data-xy="xo:50px,37px,19px,11px;yo:160px,120px,64px,39px;"
                                                                                    data-pos="r"
                                                                                    data-text="w:normal;s:20,15,8,4;c:both;l:0,18,9,6;"
                                                                                    data-flcr="c:both;"
                                                                                    data-dim="w:100%;h:20px,20px,20px,18px;"
                                                                                    data-frame_999="o:0;st:w;sR:8700;"
                                                                                    style="z-index:10;"></rs-layer>
                                                                                <!-- -->
                                                                            </rs-column>
                                                                            <!-- -->
                                                                        </rs-row>
                                                                        <!-- -->
                                                                    </rs-zone>
                                                                    <!-- -->
                                                                </rs-slide>
                                                                @endforeach
                                                            </rs-slides>
                                                            <rs-static-layers>
                                                                <!-- -->
                                                                <rs-layer
                                                                    id="slider-10-slide-10-layer-7"
                                                                    class="rs-layer-static"
                                                                    data-type="text"
                                                                    data-xy="xo:70px;y:m;"
                                                                    data-text="w:normal;l:20;"
                                                                    data-dim="w:67px;"
                                                                    data-vbility="t,t,f,f"
                                                                    data-actions='o:click;a:jumptoslide;slide:previous;'
                                                                    data-basealign="slide"
                                                                    data-rsp_o="off"
                                                                    data-rsp_bd="off"
                                                                    data-onslides="s:1;"
                                                                    data-layeronlimit="on"
                                                                    data-frame_0="sX:0.9;sY:0.9;"
                                                                    data-frame_1="e:power2.inOut;sp:1000;"
                                                                    data-frame_999="o:0;st:w;"
                                                                    data-frame_hover="o:0.8;"
                                                                    style="z-index:7;font-family:'Roboto';cursor:pointer;">
                                                                    <svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        width="100%"
                                                                        height="100%"
                                                                        viewbox="0 0 66.914 58.441">
                                                                        <g id="down-arrow" transform="translate(0 58.441) rotate(-90)"><path
                                                                            d="M26.167,66.914V11.694L4.321,33.541,0,29.221,29.221,0,58.441,29.221l-4.321,4.32L32.274,11.694v55.22Z"
                                                                            transform="translate(0)"
                                                                            fill="#efe8ce"/></g>
                                                                    </svg>
                                                                </rs-layer>
                                                                <!-- -->
                                                                <rs-layer
                                                                    id="slider-10-slide-10-layer-8"
                                                                    class="rs-layer-static"
                                                                    data-type="text"
                                                                    data-xy="x:r;xo:70px;y:m;"
                                                                    data-text="w:normal;l:20;"
                                                                    data-dim="w:67px;"
                                                                    data-vbility="t,t,f,f"
                                                                    data-actions='o:click;a:jumptoslide;slide:next;'
                                                                    data-basealign="slide"
                                                                    data-rsp_o="off"
                                                                    data-rsp_bd="off"
                                                                    data-onslides="s:1;"
                                                                    data-layeronlimit="on"
                                                                    data-frame_0="sX:0.9;sY:0.9;"
                                                                    data-frame_1="e:power2.inOut;sp:1000;"
                                                                    data-frame_999="o:0;st:w;"
                                                                    data-frame_hover="o:0.8;"
                                                                    style="z-index:6;font-family:'Roboto';cursor:pointer;">
                                                                    <svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        width="100%"
                                                                        height="100%"
                                                                        viewbox="0 0 66.914 58.441">
                                                                        <g id="down-arrow" transform="translate(-28 89.301) rotate(-90)"><path
                                                                            id="Path_31354"
                                                                            data-name="Path 31354"
                                                                            d="M57.027,28V83.22L35.18,61.373l-4.32,4.32L60.081,94.914,89.3,65.694l-4.32-4.32L63.134,83.22V28Z"
                                                                            transform="translate(0)"
                                                                            fill="#efe8ce"/></g>
                                                                    </svg>
                                                                </rs-layer>
                                                                <!-- -->
                                                            </rs-static-layers>
                                                        </rs-module>
                                                        <script>
                                                            setREVStartSize({
                                                                c: 'rev_slider_10_1',
                                                                rl: [
                                                                    1240, 1460, 785, 500
                                                                ],
                                                                el: [
                                                                    860, 700, 580, 480
                                                                ],
                                                                gw: [
                                                                    1920, 1440, 778, 480
                                                                ],
                                                                gh: [
                                                                    860, 700, 580, 480
                                                                ],
                                                                type: 'standard',
                                                                justify: '',
                                                                layout: 'fullscreen',
                                                                offsetContainer: '',
                                                                offset: '',
                                                                mh: "480px"
                                                            });
                                                            if (window.RS_MODULES !== undefined && window.RS_MODULES.modules !== undefined && window.RS_MODULES.modules["revslider101"] !== undefined) {
                                                                window
                                                                    .RS_MODULES
                                                                    .modules["revslider101"]
                                                                    .once = false;
                                                                window.revapi10 = undefined;
                                                                if (window.RS_MODULES.checkMinimal !== undefined) 
                                                                    window
                                                                        .RS_MODULES
                                                                        .checkMinimal()
                                                                }
                                                        </script>
                                                    </rs-module-wrap>
                                                    <!-- END REVOLUTION SLIDER -->
                                                </div>
                                            </div>
                                        </aside>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section
                class="elementor-section elementor-top-section elementor-element elementor-element-63e8f22 elementor-section-full_width elementor-section-height-default elementor-section-height-default sc_fly_static"
                data-id="63e8f22"
                data-element_type="section">
                <div class="elementor-container elementor-column-gap-no">
                    <div
                        class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-de35604 sc_inner_width_none sc_content_align_inherit sc_layouts_column_icons_position_left sc_fly_static"
                        data-id="de35604"
                        data-element_type="column">
                        <div class="elementor-widget-wrap elementor-element-populated">
                            <div
                                class="elementor-element elementor-element-6e4b0fa sc_height_extra_huge sc_fly_static elementor-widget elementor-widget-spacer"
                                data-id="6e4b0fa"
                                data-element_type="widget"
                                data-widget_type="spacer.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-spacer">
                                        <div class="elementor-spacer-inner"></div>
                                    </div>
                                </div>
                            </div>
                            <section
                                class="elementor-section elementor-inner-section elementor-element elementor-element-951fd13 elementor-section-content-bottom animation_type_sequental elementor-section-boxed elementor-section-height-default elementor-section-height-default sc_fly_static elementor-invisible"
                                data-id="951fd13"
                                data-element_type="section"
                                data-settings="{&quot;animation&quot;:&quot;dub-fadeinup&quot;}">
                                <div class="elementor-container elementor-column-gap-extended">
                                    <div
                                        class="elementor-column elementor-col-66 elementor-inner-column elementor-element elementor-element-43f6a0d sc_inner_width_none sc_content_align_inherit sc_layouts_column_icons_position_left sc_fly_static"
                                        data-id="43f6a0d"
                                        data-element_type="column">
                                        <div class="elementor-widget-wrap elementor-element-populated">
                                            <div
                                                class="elementor-element elementor-element-2be2c16 sc_fly_static elementor-widget elementor-widget-trx_sc_title"
                                                data-id="2be2c16"
                                                data-element_type="widget"
                                                data-widget_type="trx_sc_title.default">
                                                <div class="elementor-widget-container">
                                                    <div class="sc_title sc_title_default">
                                                        <span
                                                            class="sc_item_subtitle sc_title_subtitle sc_item_subtitle_above sc_item_title_style_default">Music albums</span>
                                                        <h1
                                                            class="sc_item_title sc_title_title sc_item_title_style_default sc_item_title_tag">
                                                            <span class="sc_item_title_text">Recommended for you</span>
                                                        </h1>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-4118c3e sc_layouts_column_align_right sc_layouts_column sc-mobile_layouts_column_align_left sc_layouts_column sc_inner_width_none sc_content_align_inherit sc_layouts_column_icons_position_left sc_fly_static"
                                        data-id="4118c3e"
                                        data-element_type="column">
                                        <div class="elementor-widget-wrap elementor-element-populated">
                                            <div
                                                class="elementor-element elementor-element-1d195f8 sc_layouts_hide_on_wide sc_layouts_hide_on_desktop sc_layouts_hide_on_notebook sc_layouts_hide_on_tablet sc_fly_static elementor-widget elementor-widget-spacer"
                                                data-id="1d195f8"
                                                data-element_type="widget"
                                                data-widget_type="spacer.default">
                                                <div class="elementor-widget-container">
                                                    <div class="elementor-spacer">
                                                        <div class="elementor-spacer-inner"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="elementor-element elementor-element-82bcccb elementor-widget__width-auto sc_fly_static elementor-widget elementor-widget-trx_sc_slider_controls"
                                                data-id="82bcccb"
                                                data-element_type="widget"
                                                data-widget_type="trx_sc_slider_controls.default">
                                                <div class="elementor-widget-container">
                                                    <div
                                                        class="sc_slider_controls sc_slider_controls_alter slider_pagination_style_none sc_align_right"
                                                        data-slider-id="event-controls"
                                                        data-style="alter"
                                                        data-pagination-style="none">
                                                        <div class="slider_controls_wrap with_prev with_next">
                                                            <a class="slider_prev" href="#"></a>
                                                            <a class="slider_next" href="#"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div
                                class="elementor-element elementor-element-26d2825 sc_height_small sc_fly_static elementor-widget elementor-widget-spacer"
                                data-id="26d2825"
                                data-element_type="widget"
                                data-widget_type="spacer.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-spacer">
                                        <div class="elementor-spacer-inner"></div>
                                    </div>
                                </div>
                            </div>
                            <section
                                class="elementor-section elementor-inner-section elementor-element elementor-element-080c5cf elementor-section-boxed elementor-section-height-default elementor-section-height-default sc_fly_static"
                                data-id="080c5cf"
                                data-element_type="section">
                                <div class="elementor-container elementor-column-gap-no">
                                    <div
                                        class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-696f908 sc_extra_bg_extra_left sc_inner_width_none sc_content_align_inherit sc_layouts_column_icons_position_left sc_fly_static"
                                        data-id="696f908"
                                        data-element_type="column"
                                        data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                        <div class="elementor-widget-wrap elementor-element-populated">
                                            <div
                                                class="elementor-element elementor-element-9ae239f animation_type_sequental sc_fly_static elementor-invisible elementor-widget elementor-widget-trx_sc_events"
                                                data-id="9ae239f"
                                                data-element_type="widget"
                                                id="event-controls"
                                                data-settings="{&quot;_animation&quot;:&quot;dub-fadeinup&quot;}"
                                                data-widget_type="trx_sc_events.default">
                                                <div class="elementor-widget-container">
                                                    <div
                                                        id="event-controls_sc"
                                                        class="sc_events color_style_link2 sc_events_classic">
                                                        <div
                                                            id="event-controls_sc_outer"
                                                            class="sc_events_slider sc_item_slider slider_swiper_outer slider_outer slider_outer_nocontrols slider_outer_nopagination slider_outer_nocentered slider_outer_overflow_visible slider_outer_multi">
                                                            <div
                                                                id="event-controls_sc_swiper"
                                                                data-slides-per-view-breakpoints="{&quot;999999&quot;:3}"
                                                                class="slider_container swiper-slider-container slider_swiper slider_noresize slider_nocontrols slider_nopagination slider_nocentered slider_overflow_visible slider_multi"
                                                                data-slides-per-view="3"
                                                                data-slides-space="30"
                                                                data-effect="slide"
                                                                data-slides-min-width="220"
                                                                data-pagination="bullets"
                                                                data-direction="horizontal"
                                                                data-mouse-wheel="0"
                                                                data-autoplay="1"
                                                                data-loop="1"
                                                                data-free-mode="0"
                                                                data-slides-centered="0"
                                                                data-slides-overflow="1">
                                                                <div class="slides slider-wrapper swiper-wrapper sc_item_columns_3">
                                                                    <div class="slider-slide swiper-slide">
                                                                        <div class="sc_events_item sc_item_container post_container">

                                                                            <div class="sc_events_item_content">

                                                                                <div
                                                                                    class="sc_events_item_featured"
                                                                                    style="background-image: url(https://dub.ancorathemes.com/wp-content/uploads/2020/04/image-46-copyright-840x881.jpg);"></div>

                                                                                <div class="sc_events_item_content_inner">

                                                                                    <div class="sc_events_item_content_inner_top">
                                                                                        <div class="sc_events_item_meta_categories">
                                                                                            <a
                                                                                                href="https://dub.ancorathemes.com/events/category/music/"
                                                                                                title="View all posts in Music">Music</a>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="sc_events_item_content_inner_bottom">
                                                                                        <h4 class="sc_events_item_title">
                                                                                            <a href="https://dub.ancorathemes.com/event/radiant-rhythm-reverie/">Radiant rhythm reverie</a>
                                                                                        </h4>
                                                                                        <div class="sc_events_item_meta">
                                                                                            <span class="sc_events_item_meta_item sc_events_item_meta_date">Started on
                                                                                                <span class="sc_events_item_date sc_events_item_date_start">Aug 13, 2024</span>
                                                                                                to
                                                                                                <span class="sc_events_item_date sc_events_item_date_end">Sep 14, 2027</span>
                                                                                            </span>
                                                                                        </div>

                                                                                    </div>
                                                                                    <a class="sc_events_item_link" onclick="alert('sedang dalam pengembangan')"></a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="slider-slide swiper-slide">
                                                                        <div class="sc_events_item sc_item_container post_container">

                                                                            <div class="sc_events_item_content">

                                                                                <div
                                                                                    class="sc_events_item_featured"
                                                                                    style="background-image: url(https://dub.ancorathemes.com/wp-content/uploads/2020/04/image-44-copyright-840x881.jpg);"></div>

                                                                                <div class="sc_events_item_content_inner">

                                                                                    <div class="sc_events_item_content_inner_top">
                                                                                        <div class="sc_events_item_meta_categories">
                                                                                            <a
                                                                                                href="https://dub.ancorathemes.com/events/category/music/"
                                                                                                title="View all posts in Music">Music</a>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="sc_events_item_content_inner_bottom">
                                                                                        <h4 class="sc_events_item_title">
                                                                                            <a href="https://dub.ancorathemes.com/event/sonic-symphony-saga/">Sonic symphony saga</a>
                                                                                        </h4>
                                                                                        <div class="sc_events_item_meta">
                                                                                            <span class="sc_events_item_meta_item sc_events_item_meta_date">Started on
                                                                                                <span class="sc_events_item_date sc_events_item_date_start">Oct 3, 2024</span>
                                                                                                to
                                                                                                <span class="sc_events_item_date sc_events_item_date_end">Oct 19, 2027</span>
                                                                                            </span>
                                                                                        </div>

                                                                                    </div>
                                                                                    <a class="sc_events_item_link" onclick="alert('sedang dalam pengembangan')"></a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="slider-slide swiper-slide">
                                                                        <div class="sc_events_item sc_item_container post_container">

                                                                            <div class="sc_events_item_content">

                                                                                <div
                                                                                    class="sc_events_item_featured"
                                                                                    style="background-image: url(https://dub.ancorathemes.com/wp-content/uploads/2020/04/image-107-copyright-840x881.jpg);"></div>

                                                                                <div class="sc_events_item_content_inner">

                                                                                    <div class="sc_events_item_content_inner_top">
                                                                                        <div class="sc_events_item_meta_categories">
                                                                                            <a
                                                                                                href="https://dub.ancorathemes.com/events/category/music/"
                                                                                                title="View all posts in Music">Music</a>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="sc_events_item_content_inner_bottom">
                                                                                        <h4 class="sc_events_item_title">
                                                                                            <a href="https://dub.ancorathemes.com/event/journey-through-silence/">Journey through silence</a>
                                                                                        </h4>
                                                                                        <div class="sc_events_item_meta">
                                                                                            <span class="sc_events_item_meta_item sc_events_item_meta_date">Started on
                                                                                                <span class="sc_events_item_date sc_events_item_date_start">Oct 17, 2024</span>
                                                                                                to
                                                                                                <span class="sc_events_item_date sc_events_item_date_end">Oct 25, 2027</span>
                                                                                            </span>
                                                                                        </div>

                                                                                    </div>
                                                                                    <a class="sc_events_item_link" onclick="alert('sedang dalam pengembangan')"></a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="slider-slide swiper-slide">
                                                                        <div class="sc_events_item sc_item_container post_container">

                                                                            <div class="sc_events_item_content">

                                                                                <div
                                                                                    class="sc_events_item_featured"
                                                                                    style="background-image: url(https://dub.ancorathemes.com/wp-content/uploads/2020/04/image-45-copyright-840x881.jpg);"></div>

                                                                                <div class="sc_events_item_content_inner">

                                                                                    <div class="sc_events_item_content_inner_top">
                                                                                        <div class="sc_events_item_meta_categories">
                                                                                            <a
                                                                                                href="https://dub.ancorathemes.com/events/category/music/"
                                                                                                title="View all posts in Music">Music</a>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="sc_events_item_content_inner_bottom">
                                                                                        <h4 class="sc_events_item_title">
                                                                                            <a href="https://dub.ancorathemes.com/event/urban-echo-ensemble/">Urban echo ensemble</a>
                                                                                        </h4>
                                                                                        <div class="sc_events_item_meta">
                                                                                            <span class="sc_events_item_meta_item sc_events_item_meta_date">Started on
                                                                                                <span class="sc_events_item_date sc_events_item_date_start">Oct 27, 2024</span>
                                                                                                to
                                                                                                <span class="sc_events_item_date sc_events_item_date_end">Nov 1, 2027</span>
                                                                                            </span>
                                                                                        </div>

                                                                                    </div>
                                                                                    <a class="sc_events_item_link" onclick="alert('sedang dalam pengembangan')"></a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="slider-slide swiper-slide">
                                                                        <div class="sc_events_item sc_item_container post_container">

                                                                            <div class="sc_events_item_content">

                                                                                <div
                                                                                    class="sc_events_item_featured"
                                                                                    style="background-image: url(https://dub.ancorathemes.com/wp-content/uploads/2020/04/image-42-copyright-840x881.jpg);"></div>

                                                                                <div class="sc_events_item_content_inner">

                                                                                    <div class="sc_events_item_content_inner_top">
                                                                                        <div class="sc_events_item_meta_categories">
                                                                                            <a
                                                                                                href="https://dub.ancorathemes.com/events/category/music/"
                                                                                                title="View all posts in Music">Music</a>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="sc_events_item_content_inner_bottom">
                                                                                        <h4 class="sc_events_item_title">
                                                                                            <a href="https://dub.ancorathemes.com/event/soulful-serenade-stories/">Soulful serenade stories</a>
                                                                                        </h4>
                                                                                        <div class="sc_events_item_meta">
                                                                                            <span class="sc_events_item_meta_item sc_events_item_meta_date">Started on
                                                                                                <span class="sc_events_item_date sc_events_item_date_start">Oct 28, 2024</span>
                                                                                                to
                                                                                                <span class="sc_events_item_date sc_events_item_date_end">Nov 8, 2027</span>
                                                                                            </span>
                                                                                        </div>

                                                                                    </div>
                                                                                    <a class="sc_events_item_link" onclick="alert('sedang dalam pengembangan')"></a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div
                                class="elementor-element elementor-element-11e9edc sc_height_extra_huge sc_fly_static elementor-widget elementor-widget-spacer"
                                data-id="11e9edc"
                                data-element_type="widget"
                                data-widget_type="spacer.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-spacer">
                                        <div class="elementor-spacer-inner"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section
                class="elementor-section elementor-top-section elementor-element elementor-element-681cee3 elementor-section-boxed elementor-section-height-default elementor-section-height-default sc_fly_static"
                data-id="681cee3"
                data-element_type="section">
                <div class="elementor-container elementor-column-gap-extended">
                    <div
                        class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-11a409f sc_inner_width_none sc_content_align_inherit sc_layouts_column_icons_position_left sc_fly_static"
                        data-id="11a409f"
                        data-element_type="column">
                        <div class="elementor-widget-wrap elementor-element-populated">
                            <section
                                class="elementor-section elementor-inner-section elementor-element elementor-element-288b777 elementor-section-boxed elementor-section-height-default elementor-section-height-default animation_type_block sc_fly_static elementor-invisible"
                                data-id="288b777"
                                data-element_type="section"
                                data-settings="{&quot;animation&quot;:&quot;dub-fadeinup&quot;}">
                                <div class="elementor-container elementor-column-gap-no">
                                    <div
                                        class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-78d5364 sc_inner_width_none sc_content_align_inherit sc_layouts_column_icons_position_left sc_fly_static"
                                        data-id="78d5364"
                                        data-element_type="column">
                                        <div class="elementor-widget-wrap elementor-element-populated">
                                            <div
                                                class="elementor-element elementor-element-35b29ac sc_fly_static elementor-widget elementor-widget-trx_sc_title"
                                                data-id="35b29ac"
                                                data-element_type="widget"
                                                data-widget_type="trx_sc_title.default">
                                                <div class="elementor-widget-container">
                                                    <div class="sc_title sc_title_default">
                                                        <span
                                                            class="sc_item_subtitle sc_title_subtitle sc_item_subtitle_above sc_item_title_style_default">Articles</span>
                                                        <h3
                                                            class="sc_item_title sc_title_title sc_item_title_style_default sc_item_title_tag">
                                                            <span class="sc_item_title_text">Our events</span>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="elementor-icon-box-content">

                                                <span class="elementor-icon-box-title">
                                                    <span >
                                                        11:15 a.m. – 12:15 p.m.
                                                    </span>
                                                </span>

                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-45830c2 sc_inner_width_none sc_content_align_inherit sc_layouts_column_icons_position_left sc_fly_static"
                                        data-id="45830c2"
                                        data-element_type="column">
                                        <div class="elementor-widget-wrap elementor-element-populated">
                                            <div
                                                class="elementor-element elementor-element-74f2c0a sc_fly_static elementor-widget elementor-widget-spacer"
                                                data-id="74f2c0a"
                                                data-element_type="widget"
                                                data-widget_type="spacer.default">
                                                <div class="elementor-widget-container">
                                                    <div class="elementor-spacer">
                                                        <div class="elementor-spacer-inner"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="elementor-element elementor-element-a5c8dd2 sc_fly_static elementor-widget elementor-widget-text-editor"
                                                data-id="a5c8dd2"
                                                data-element_type="widget"
                                                data-widget_type="text-editor.default">
                                                <div class="elementor-widget-container">
                                                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                                                        doloremque laudantium.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-d85c021 sc_layouts_column_align_right sc_layouts_column sc-mobile_layouts_column_align_left sc_layouts_column sc_inner_width_none sc_content_align_inherit sc_layouts_column_icons_position_left sc_fly_static"
                                        data-id="d85c021"
                                        data-element_type="column">
                                        <div class="elementor-widget-wrap elementor-element-populated">
                                            <div
                                                class="elementor-element elementor-element-5110ee5 sc_fly_static elementor-widget elementor-widget-spacer"
                                                data-id="5110ee5"
                                                data-element_type="widget"
                                                data-widget_type="spacer.default">
                                                <div class="elementor-widget-container">
                                                    <div class="elementor-spacer">
                                                        <div class="elementor-spacer-inner"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="elementor-element elementor-element-72f433f sc_fly_static elementor-widget elementor-widget-trx_sc_button"
                                                data-id="72f433f"
                                                data-element_type="widget"
                                                data-widget_type="trx_sc_button.default">
                                                <div class="elementor-widget-container">
                                                    <div class="sc_item_button sc_button_wrap">
                                                        <a
                                                            onclick="alert('Sedang Dalam Pengembangan')"
                                                            class="sc_button sc_button_default sc_button_size_normal sc_button_with_icon sc_button_icon_left">
                                                            <span class="sc_button_icon">
                                                                <span class="icon-ticket"></span>
                                                            </span>
                                                            <span class="sc_button_text">
                                                                <span class="sc_button_title">Read More</span>
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section
                                class="elementor-section elementor-inner-section elementor-element elementor-element-288b777 elementor-section-boxed elementor-section-height-default elementor-section-height-default animation_type_block sc_fly_static elementor-invisible"
                                data-id="288b777"
                                data-element_type="section"
                                data-settings="{&quot;animation&quot;:&quot;dub-fadeinup&quot;}"
                                style="border-top:1px solid #000;margin-top: 15px;padding-top: 11px;">
                                <div class="elementor-container elementor-column-gap-no">
                                    <div
                                        class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-78d5364 sc_inner_width_none sc_content_align_inherit sc_layouts_column_icons_position_left sc_fly_static"
                                        data-id="78d5364"
                                        data-element_type="column">
                                        <div class="elementor-widget-wrap elementor-element-populated">
                                            <div
                                                class="elementor-element elementor-element-35b29ac sc_fly_static elementor-widget elementor-widget-trx_sc_title"
                                                data-id="35b29ac"
                                                data-element_type="widget"
                                                data-widget_type="trx_sc_title.default">
                                                <div class="elementor-widget-container">
                                                    <div class="sc_title sc_title_default">
                                                        <h3
                                                            class="sc_item_title sc_title_title sc_item_title_style_default sc_item_title_tag">
                                                            <span class="sc_item_title_text">Our events</span>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="elementor-icon-box-content">

                                                <span class="elementor-icon-box-title">
                                                    <span >
                                                        11:15 a.m. – 12:15 p.m.
                                                    </span>
                                                </span>

                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="elementor-column elementor-col-50 elementor-inner-column elementor-element elementor-element-45830c2 sc_inner_width_none sc_content_align_inherit sc_layouts_column_icons_position_left sc_fly_static"
                                        data-id="45830c2"
                                        data-element_type="column">
                                        <div class="elementor-widget-wrap elementor-element-populated">
                                            <div
                                                class="elementor-element elementor-element-74f2c0a sc_fly_static elementor-widget elementor-widget-spacer"
                                                data-id="74f2c0a"
                                                data-element_type="widget"
                                                data-widget_type="spacer.default">
                                                <div class="elementor-widget-container">
                                                    <div class="elementor-spacer">
                                                        <div class="elementor-spacer-inner"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="elementor-element elementor-element-a5c8dd2 sc_fly_static elementor-widget elementor-widget-text-editor"
                                                data-id="a5c8dd2"
                                                data-element_type="widget"
                                                data-widget_type="text-editor.default">
                                                <div class="elementor-widget-container">
                                                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                                                        doloremque laudantium.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="elementor-column elementor-col-25 elementor-inner-column elementor-element elementor-element-d85c021 sc_layouts_column_align_right sc_layouts_column sc-mobile_layouts_column_align_left sc_layouts_column sc_inner_width_none sc_content_align_inherit sc_layouts_column_icons_position_left sc_fly_static"
                                        data-id="d85c021"
                                        data-element_type="column">
                                        <div class="elementor-widget-wrap elementor-element-populated">
                                            <div
                                                class="elementor-element elementor-element-5110ee5 sc_fly_static elementor-widget elementor-widget-spacer"
                                                data-id="5110ee5"
                                                data-element_type="widget"
                                                data-widget_type="spacer.default">
                                                <div class="elementor-widget-container">
                                                    <div class="elementor-spacer">
                                                        <div class="elementor-spacer-inner"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="elementor-element elementor-element-72f433f sc_fly_static elementor-widget elementor-widget-trx_sc_button"
                                                data-id="72f433f"
                                                data-element_type="widget"
                                                data-widget_type="trx_sc_button.default">
                                                <div class="elementor-widget-container">
                                                    <div class="sc_item_button sc_button_wrap">
                                                        <a
                                                            onclick="alert('Sedang Dalam Pengembangan')"
                                                            class="sc_button sc_button_default sc_button_size_normal sc_button_with_icon sc_button_icon_left">
                                                            <span class="sc_button_icon">
                                                                <span class="icon-ticket"></span>
                                                            </span>
                                                            <span class="sc_button_text">
                                                                <span class="sc_button_title">Read More</span>
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div
                                class="elementor-element elementor-element-99d4506 sc_height_extra_huge sc_fly_static elementor-widget elementor-widget-spacer"
                                data-id="99d4506"
                                data-element_type="widget"
                                data-widget_type="spacer.default">
                                <div class="elementor-widget-container">
                                    <div class="elementor-spacer">
                                        <div class="elementor-spacer-inner"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
    <!-- .entry-content -->
</div>
@endsection