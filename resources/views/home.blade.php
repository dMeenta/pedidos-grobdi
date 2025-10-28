@php
    $showFrom = \Carbon\Carbon::createFromDate(\Carbon\Carbon::now()->year, 10, 24);
    $showUntil = \Carbon\Carbon::createFromDate(\Carbon\Carbon::now()->year, 11, 10)->endOfDay();
    $showDiaDeMuertos = \Carbon\Carbon::now()->between($showFrom, $showUntil);
@endphp

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    @if (!$showDiaDeMuertos)
        <h1>Indicadores</h1>
    @endif
@stop

@section('content')
    @if ($showDiaDeMuertos)
        <div class="scary-banner position-relative">
            <div class="ofrenda-container text-center">
                <h2>¡El sistema fue raptado! 👹</h2>
                <p>Por Los malditos de SysGrob 😈</p>
                <div>
                    <img src="https://media1.giphy.com/media/v1.Y2lkPTc5MGI3NjExZHlocmptbTFiMXdraW55NGM5ZmdzNDB6NW8wd2l3bjViNTJkbDZjNCZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/JpM42T4Mnd4FKWq74i/giphy.gif"
                        alt="" class="h-100">
                </div>
            </div>

            <span class="scary-span" style="top: 10%; left: 5%;">🎃</span>
            <span class="scary-span" style="top: 20%; right: 8%;">🕸️</span>
            <span class="scary-span" style="top: 40%; left: 10%;">💀</span>
            <span class="scary-span" style="bottom: 15%; right: 12%;">🩻</span>
            <span class="scary-span" style="bottom: 25%; right: 15%;">💀</span>
            <span class="scary-span" style="top: 60%; left: 15%;">🕸️</span>
            <span class="scary-span" style="bottom: 10%; left: 50%;">🎃</span>
        </div>
    @else
        <p>Bienvenidos</p>
    @endif
@stop

@section('css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Creepster&family=Montserrat:wght@400;600&display=swap');

        .scary-banner {
            position: relative;
            background: linear-gradient(135deg, #1a1a1a 0%, #4a1c6b 50%, #d95700 100%);
            color: white;
            padding: 2rem;
            width: 100%;
            min-height: 90dvh;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .ofrenda-container {
            font-family: 'Creepster', cursive;
            text-shadow: 2px 10px 5px rgba(0, 0, 0, 0.6);
            display: flex;
            flex-direction: column;
            flex justify-items: center;
            justify-content: center;
            gap: 5px;
        }

        .ofrenda-container h2 {
            font-size: 2.4rem;
            word-spacing: 10px;
        }

        .ofrenda-container p {
            font-size: 1.5rem;
            word-spacing: 5px;
        }

        .scary-span {
            position: absolute;
            font-size: 2rem;
            animation: float 4s ease-in-out infinite;
            z-index: 0;
        }

        /* Diferentes retrasos para que floten de forma orgánica */
        .scary-span:nth-of-type(1) {
            animation-delay: 0s;
        }

        .scary-span:nth-of-type(2) {
            animation-delay: 1.2s;
        }

        .scary-span:nth-of-type(3) {
            animation-delay: 2.1s;
        }

        .scary-span:nth-of-type(4) {
            animation-delay: 0.7s;
        }

        .scary-span:nth-of-type(5) {
            animation-delay: 1.8s;
        }

        .scary-span:nth-of-type(6) {
            animation-delay: 0.3s;
        }

        .scary-span:nth-of-type(7) {
            animation-delay: 2.5s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-12px) rotate(5deg);
            }
        }
    </style>
@stop
