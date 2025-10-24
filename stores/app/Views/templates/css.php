<style>
/* Products Show  */

.product_offer {
    position: absolute;
    top: 1% !important;
    left: 1% !important;
    background-color: #ff0000;
    color: #fff;
    padding: 5px;
    border-radius: 5px 0 10px 0;
    font-size: 10px !important;
    font-weight: bold;
    width: 40px;
    height: 20px;
    z-index: 120px !important;

}



.blink-btn {
    position: relative;
    animation: pulseBlink 1.5s ease-in-out infinite;
    background: linear-gradient(135deg, #233a95 0%, #1a2d75 100%) !important;
    color: rgb(211, 235, 239);
    border: 2px solid rgba(211, 235, 239, 0.3);
    box-shadow: 0 4px 15px rgba(35, 58, 149, 0.4),
        0 0 20px rgba(35, 58, 149, 0.2);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
    font-weight: 600;
    letter-spacing: 0.5px;
}

/* Shimmer effect overlay */
.blink-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg,
            transparent,
            rgba(211, 235, 239, 0.3),
            transparent);
    transition: left 0.5s;
}

.blink-btn:hover::before {
    left: 100%;
}

.blink-btn:hover {
    color: #233a95 !important;
    background: linear-gradient(135deg, rgb(211, 235, 239) 0%, rgba(211, 235, 239, 0.9) 100%) !important;
    border-color: #233a95;
    box-shadow: 0 6px 25px rgba(35, 58, 149, 0.5),
        0 0 30px rgba(35, 58, 149, 0.3),
        inset 0 1px 3px rgba(255, 255, 255, 0.8);
    transform: translateY(-2px) scale(1.02);
    animation: none;
}

.blink-btn:active {
    transform: translateY(0) scale(0.98);
    box-shadow: 0 2px 10px rgba(35, 58, 149, 0.4);
}

/* Enhanced pulse blink animation */
@keyframes pulseBlink {
    0% {
        opacity: 1;
        transform: scale(1);
        box-shadow: 0 4px 15px rgba(35, 58, 149, 0.4),
            0 0 20px rgba(35, 58, 149, 0.2);
    }

    50% {
        opacity: 0.6;
        transform: scale(1.01);
        box-shadow: 0 6px 20px rgba(35, 58, 149, 0.6),
            0 0 30px rgba(35, 58, 149, 0.4);
    }

    100% {
        opacity: 1;
        transform: scale(1);
        box-shadow: 0 4px 15px rgba(35, 58, 149, 0.4),
            0 0 20px rgba(35, 58, 149, 0.2);
    }
}

/* Glow effect variant - add this class for extra emphasis */
.blink-btn.glow {
    animation: pulseGlow 2s ease-in-out infinite;
}

@keyframes pulseGlow {

    0%,
    100% {
        box-shadow: 0 4px 15px rgba(35, 58, 149, 0.4),
            0 0 20px rgba(35, 58, 149, 0.3),
            0 0 40px rgba(35, 58, 149, 0.1);
    }

    50% {
        box-shadow: 0 6px 25px rgba(35, 58, 149, 0.6),
            0 0 40px rgba(35, 58, 149, 0.5),
            0 0 60px rgba(35, 58, 149, 0.3);
    }
}

/* Ripple effect on click */
.blink-btn::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(211, 235, 239, 0.5);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}

.blink-btn:active::after {
    width: 300px;
    height: 300px;
    opacity: 0;
}

/* Focus state for accessibility */
.blink-btn:focus {
    outline: none;
    box-shadow: 0 4px 15px rgba(35, 58, 149, 0.4),
        0 0 20px rgba(35, 58, 149, 0.2),
        0 0 0 3px rgba(211, 235, 239, 0.5);
}

/* Disabled state */
.blink-btn:disabled {
    animation: none;
    opacity: 0.5;
    cursor: not-allowed;
    background: #6b7280 !important;
    box-shadow: none;
}

.blink-btn:disabled:hover {
    transform: none;
    background: #6b7280 !important;
    color: #d3d3d3 !important;
}

.card-product-names {
    font-size: 16px !important;
    /* color : #233a95; */
}








@media screen and (max-width: 450px) {
    .prodprice {
        position: absolute;
        bottom: 5% !important;
        left: 5% !important;
    }

    #addCart2,
    .addCart2 {
        position: absolute;
        bottom: 5% !important;
        right: 5% !important;
        width: 25% !important;

    }
}

.smallview-prod {
    height: 170px !important;
}

.prodpriceh {
    position: absolute;
    bottom: 5% !important;
    left: 5% !important;
}


@media screen and (min-width: 1020px) {

    .addCart1 {
        position: absolute !important;
        bottom: 2%;
        margin-top: 100px !important;
        left: 50%;
        transform: translateX(-50%);
    }

    .addCart1:hover {
        transform: translateX(-50%) !important;
    }

    .prodprice {
        margin-bottom: 40px !important;
    }
}


/* @media screen and (min-width: 1020px) and (max-width: 1420px) {
    .sidebar ul li a {
        font-size: 12px !important;
    }

    .sidebar {
        width: 280px !important;

    }

    .qty-select {
        width: 200px !important;
    }

} */
@media screen and (min-width: 1260px) and (max-width: 1420px) {
    .sidebar ul li a {
        font-size: 12px !important;
    }

    .sidebar {
        width: 250px !important;
    }

    .qty-select {
        width: 10px !important;
    }

    /* .category-plus{
        margin-right: 50px !important;
    } */


}

.qty-select {
    width: 100px ;
    text-align: center ;

}

@media screen and (min-width: 360px) and (max-width: 520px) {

    .qty-select {
        width: 100px !important;
        text-align: center !important;

    }

    .qty-btn1 {
        width: 20px;
        padding-left: 5px !important;
    }

    .qty-group {
        width: 115px !important;
    }



}
</style>