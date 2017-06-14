@extends('layouts.master')
@section('title','毅行回顾')
@section('color','green')
@section('rebackyx_active','active')
@section('content')
    <div class="slider">
        <ul class="slides">
            <volist name="piclist" id="vo">
                <if condition="$vo.showtype eq lb">
                    <li>
                        <if condition="$vo.outlink neq Null">  <a href="{$vo.outlink}" target="_blank">
                                <img src="../img/{$vo.ulink}">
                            </a>
                            <else />
                            <img src="../img/{$vo.ulink}">
                        </if>
                        <div class="caption {$vo.ralign}-align">
                            <h3>{$vo.title}</h3>
                            <h5 class="light grey-text text-lighten-3">{$vo.description}</h5>
                        </div>
                    </li>
                </if>
            </volist>

        </ul>
    </div>

    <div class="container">


        <!-- Wrapper for slides -->
        <div class="row">
            <volist name="piclist" id="vo">
                <if condition="$vo.showtype neq lb">
                    <div class="col s12 m6 l4 ">
                        <div class="card hoverable">
                            <div class="card-image">
                                <img src="../img/{$vo.ulink}" alt="">
                                <span class="card-title">{$vo.title}</span>
                                <!-- <span class="caption">关于图片的说明{$vo.description}</span> -->
                            </div>
                            <if condition="$vo.outlink neq Null">
                                <div class="card-content">
                                    {$vo.description}
                                </div>
                            </if>
                            <if condition="$vo.outlink neq Null">
                                <div class="card-action">
                                    <a href="{$vo.outlink}" target="_blank">去看看...</a>
                                </div></if>
                        </div>

                    </div>
                </if>
            </volist>
        </div>
    </div>
@endsection
