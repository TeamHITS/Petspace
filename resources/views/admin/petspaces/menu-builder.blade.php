@extends('admin.layouts.app')
@push('css')
    {{--<link rel="stylesheet" href="{{ url('public/assets/css/style.css') }}"/>--}}
    <link rel="stylesheet" href="{{ url('public/assets/css/font-awesome.css') }}">
    {{--<link rel="stylesheet" href="{{ url('public/assets/css/bootstrap.min.css') }}">--}}
    <style>
        /*SERVICE MENU PAGES START'S HERE*/
        .service-menu-card-wrap {
            max-width: 620px;
            width: 100%;
            margin: 0 auto;
        }

        .service-menu-card {
            padding: 28px 25px;
            background: #fff;
            box-shadow: 3px 21px 56px 8px rgba(0, 0, 0, 0.03);
            margin-bottom: 30px;
            border-radius: 10px;
        }

        .service-menu-card.add-service-category {
            padding: 0;
            box-shadow: 3px 21px 56px 8px rgba(0, 0, 0, 0.03);
        }

        .service-menu-card.add-new-service {
            padding: 15px;
        }

        .service-menu-card.add-new-service .add-btn {
            font-size: 14px;
            font-weight: 700;
            color: #19b69b;
            padding: 28px;
            display: flex;
            width: 100%;
            justify-content: center;
            align-items: center;
            border-radius: 7px;
            border: dashed 1px #97999b;
        }

        .service-menu-card.add-service-category .add-btn {
            color: #2e384d;
            font-size: 17px;
            font-weight: 700;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 28px 25px;
        }

        .service-menu-card-1 {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
        }

        .service-menu-card-1 .text {
            width: calc(100% - 180px);
            padding-right: 10px;
        }

        .service-menu-card-1.full-text .text {
            width: 100%;
            padding-right: 0px;
        }

        .service-menu-card-1 .text p {
            font-size: 12px;
            line-height: 1.4;
            font-weight: 500;
            color: var(--text-color-3);
            margin-top: 5px;
        }

        .service-menu-card-1 .text .title {
            margin-top: 0px;
            font-size: 22px;
            font-weight: 700;
            color: var(--text-color-1);
        }

        .service-menu-card-2 .text .title a,
        .service-menu-card-1 .text .title a,
        .service-menu-card-3 .top .text .name a,
        .sub-menu-card-3 .text .title a {
            color: #19b69b;
            font-size: 14px;
            margin-left: 10px;
        }

        .service-menu-card-1 .button-box {
            width: 180px;
        }

        .service-menu-card-1 .button-box a {
            width: 100%;
            height: 48px;
            font-size: 14px;
            font-weight: 500;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .service-menu-card-1 .button-box a:hover {
            color: var(--text-color-1);
        }

        .service-menu-card-1 .button-box a i {
            margin-right: 8px;
        }

        .service-menu-card-1 .button-box a img {
            max-width: 14px;
        }

        .service-menu-card-2 {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
        }

        .service-menu-card-2 .img {
            width: 220px;
            border-radius: 13px;
            background: #ededed;
            max-height: 143px;
            height: 143px;
            padding: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .service-menu-card-2 .img img {
            max-width: 220px;
            max-height: 143px;
            width: auto;
        }

        .service-menu-card-2 .text {
            width: calc(100% - 220px);
            padding-left: 30px;
        }

        .service-menu-card-2 .text p {
            font-size: 14px;
            line-height: 1.4;
            font-weight: 500;
            color: var(--text-color-1);
            margin-top: 5px;
        }

        .service-menu-card-2 .text .title {
            margin-top: 0px;
            font-size: 22px;
            font-weight: 700;
            color: var(--text-color-1);
        }

        .service-menu-card-2 .text .info-list {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
        }

        .service-menu-card-2 .text .info-list li {
            font-size: 12px;
            line-height: 1.3;
            font-weight: 500;
            color: var(--text-color-1);
            padding: 5px 10px;
            position: relative;
        }

        .service-menu-card-2 .text .info-list li:before {
            content: '';
            position: absolute;
            left: 0;
            top: 11px;
            width: 4px;
            height: 4px;
            border-radius: 100%;
            background: var(--text-color-1);
        }

        .service-menu-card-2 .text .info-list li:first-of-type {
            padding-left: 0;
        }

        .service-menu-card-2 .text .info-list li:first-of-type:before {
            display: none;
        }

        .service-menu-card-2 .text .info-list li .fa-star {
            color: var(--primary-color);
        }

        .service-menu-card-2 .text .sub-text {
            color: var(--text-color-3);
            font-size: 12px;
            font-weight: 500;
            margin-top: 0;
        }

        .service-menu-card-3 {
            padding: 0;
        }

        .service-menu-card-3 .top {
            border-bottom: solid 1px #ededed;
            padding: 20px 25px;
            display: flex;
            flex-wrap: wrap;
        }

        .service-menu-card-4 .top {
            border-bottom: none;
        }

        .service-menu-card-3 .top .text {
            width: calc(100% - 105px);
            padding-right: 20px;
        }

        .service-menu-card-3 .top .text p {
            color: var(--text-color-3);
            font-size: 14px;
            line-height: 1.3;
        }

        .service-menu-card-4 .top .text p {
            color: #97999b;
        }

        .service-menu-card-3 .top .text .name,
        .service-menu-card-4 .top .text .name {
            color: var(--text-color-1);
            font-size: 16px;
            font-weight: 700;
            line-height: 1.5;
            margin-bottom: 3px;
        }

        .service-menu-card-3 .top .text .price {
            color: var(--text-color-1);
            font-size: 14px;
            font-weight: 700;
            margin-top: 3px;
            line-height: 1.5;
        }

        .service-menu-card-3 .top .text .price .cut-price {
            text-decoration: line-through;
            color: #ff3a29;
            font-size: 12px;
            font-weight: 500;
            padding: 0 10px;
        }

        .service-menu-card-3 .top .text .sub-menu {
            color: #19b69b;
            line-height: 1;
            display: inline-block;
            font-size: 14px;
            font-weight: 500;
            margin-top: 12px;
        }

        .service-menu-card-3 .top .text .sub-menu i {
            margin-left: 4px;
        }

        .service-menu-card-3 .top .img {
            width: 105px;
            height: 105px;
            background: #e6e7e8;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 5px;
            overflow: hidden;
        }

        .service-menu-card-3 .top .img img {
            max-width: 100%;
            height: auto;
        }

        .service-menu-card-3 .bottom {
            padding: 20px 25px;
        }

        .service-menu-card .form-check-input {
            outline: none;
            box-shadow: none;
        }

        .service-menu-card .form-check-input:checked {
            background-color: #33ac2e;
            border-color: #33ac2e;
        }

        .service-menu-card .form-switch .form-check-input {
            height: 20px;
            width: 36px;
            margin-right: 10px;
        }

        .service-menu-card .form-switch .form-check-input:disabled {
            background-color: #676767;
            border-color: #676767;
        }

        .service-menu-card .form-switch .form-check-label {
            font-size: 14px;
            font-weight: 500;
            color: var(--text-color-1);
        }

        .sub-menu-card-1 .top {
            border-bottom: none;
        }

        .sub-menu-card-2 .top .text {
            width: 100%;
        }

        .sub-menu-card-2 .top .text .name {
            font-weight: 500;
        }

        .sub-menu-card-3 .text {
            border-bottom: solid 1px #ededed;
            padding-bottom: 15px;
        }

        .sub-menu-card-3 .bottom {
            padding-top: 10px;
        }

        .sub-menu-card-3 .bottom p {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-color-4);
        }

        .sub-menu-card-3 .text p {
            font-size: 12px;
            line-height: 1.4;
            font-weight: 500;
            color: var(--text-color-3);
            margin-top: 5px;
        }

        .sub-menu-card-3 .text .title {
            margin-top: 0px;
            font-size: 22px;
            font-weight: 700;
            color: var(--text-color-1);
        }

        .new-service-modal-top {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
        }

        .new-service-modal-top .img {
            width: 170px;
            height: 170px;
            border-radius: 8px;
            background-color: #e6e7e8;
            overflow: hidden;
        }

        .new-service-modal-top .desc {
            width: calc(100% - 170px);
            padding-left: 50px;
        }

        .new-service-modal-top .desc select {
            width: 135px;
            height: 50px;
            border-radius: 12px;
            background-color: #f8f8f8;
            border: none;
            outline: none;
            box-shadow: none;
            padding: 0px 15px 0px 20px;
            margin-bottom: 15px;
        }

        .new-service-modal-top .desc p {
            font-size: 12px;
            color: #676767;
        }

        /*SERVICE MENU PAGES END'S HERE*/

        .gen-modal .modal-dialog {
            max-width: 726px;
            width: 100%;
        }

        .gen-modal .modal-header {
            padding: 18px 30px;
            justify-content: center;
        }

        .gen-modal .modal-header .btn-close {
            position: absolute;
            right: 30px;
            outline: none;
            box-shadow: none;
        }

        .gen-modal .modal-body {
            padding: 30px;
        }

        .gen-modal .modal-footer {
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .gen-modal .modal-footer .modal-cancel-btn {
            border: solid 1px transparent;
            color: #000000;
            padding: 10px 20px 11px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 500;
            transition: all 0.25s;
            background: transparent;
        }

        .gen-modal .modal-footer .modal-cancel-btn:hover {
            background: #ffcd05;
            border-color: #ffcd05;
            color: var(--text-color-1);
        }

        .gen-modal .form-group {
            margin-bottom: 20px;
        }

        .gen-modal .form-group label {
            font-size: 14px;
            font-weight: 700;
            color: var(--text-color-1);
            margin-bottom: 10px;
        }

        .gen-modal .form-group input {

        }

        .technician-modal .technician-color-wrap {
            display: flex;
            flex-wrap: wrap;
        }

        .technician-modal .technician-color-wrap .technician-color {
            position: relative;
            margin-right: 7px;
            margin-bottom: 7px;
            width: 40px;
            height: 40px;
        }

        .technician-modal .technician-color input[type=radio] {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            width: 40px;
            height: 40px;
            z-index: 1;
            cursor: pointer;
        }

        .technician-modal .technician-color input[type=radio] + span {
            position: relative;
            width: 40px;
            height: 40px;
            border-radius: 100%;
            overflow: hidden;
            display: block;
            cursor: pointer;
        }

        .technician-modal .technician-color input[type=radio]:checked + span {
            border: solid 1px var(--primary-color);
        }

        .technician-modal .technician-color input[type=radio]:checked + span:before {
            content: '';
            width: 20px;
            height: 9px;
            position: absolute;
            top: 13px;
            left: 10px;
            border: 2px solid #fcfff4;
            border-top: none;
            border-right: none;
            background: 0 0;
            transform: rotate(-45deg);
        }

        .technician-modal .form-switch {
        }

        .technician-modal .form-switch .form-check-label span {
            display: block;
        }

        .technician-modal .form-switch .form-check-label span:nth-of-type(1) {
            font-size: 14px;
            font-weight: 700;
            color: var(--text-color-1);
            margin-bottom: 0px;
            line-height: 1;
        }

        .technician-modal .form-switch .form-check-label span:nth-of-type(2) {
            font-size: 14px;
            font-weight: 700;
            color: var(--text-color-3);
            margin-bottom: 0px;
            line-height: 1;
        }

        .technician-modal .form-check-input:checked {
            background-color: #33ac2e;
            border-color: #33ac2e;
        }

        .technician-modal .form-switch .form-check-input {
            height: 20px;
            width: 36px;
            margin-right: 10px;
        }

        .technician-modal .del-technician,
        .gen-modal .del-option {
            color: #ff3a29;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.43;
            padding: 10px 0px;
            margin-right: 20px;
            border: none;
            outline: none;
            background: transparent;
        }

        .technician-modal .delete-btn {
            color: #fff;
            background: #ff3a29;
            padding: 10px 20px 11px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 500;
            transition: all 0.25s;
            border-color: #ff3a29;
            border: none;
        }

        #deleteTechnicianModal .modal-dialog {
            max-width: 525px;
        }

        #deleteTechnicianModal .modal-header,
        #assignTechnicianModal .modal-header {
            flex-direction: column;
            flex-wrap: wrap;
            border: none;
        }

        #deleteTechnicianModal .modal-title,
        #assignTechnicianModal .modal-title {
            text-align: left;
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 5px;
            width: 100%;
        }

        #deleteTechnicianModal .modal-sub-title,
        #assignTechnicianModal .modal-sub-title {
            text-align: left;
            font-size: 14px;
            font-weight: 500;
            color: var(--text-color-4);
            width: 100%;
        }

        #deleteTechnicianModal .modal-footer,
        #assignTechnicianModal .modal-footer {
            padding: 10px 30px;
        }

        #assignTechnicianModal .modal-dialog {
            max-width: 525px;
            width: 100%;
        }

        #assignTechnicianModal .modal-body {
            padding: 10px 30px;
        }

        .new-service-modal-top {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
        }

        .new-service-modal-top .img {
            width: 170px;
            height: 170px;
            border-radius: 8px;
            background-color: #e6e7e8;
        }

        .new-service-modal-top .desc {
            width: calc(100% - 170px);
            padding-left: 50px;
        }

        .new-service-modal-top .desc select {
            width: 135px;
            height: 50px;
            border-radius: 12px;
            background-color: #f8f8f8;
            border: none;
            outline: none;
            box-shadow: none;
            padding: 0px 15px 0px 20px;
            margin-bottom: 15px;
        }

        .new-service-modal-top .desc p {
            font-size: 12px;
            color: #676767;
        }

        .gen-modal .sub-label {
            color: #676767;
            font-size: 12px;
            font-weight: 500;
            margin-bottom: 12px;
            display: block;
        }

        .gen-btn {
            border: solid 1px #e6e7e8;
            color: #2d2d2d;
            padding: 10px 20px 11px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 500;
            transition: all 0.25s;
            background: #ffcd05;
            border-color: #ffcd05;
        }

        .gen-btn:hover, .gen-btn.gen-btn-outline:hover {
            background: #ffcd05;
            border-color: #ffcd05;
            color: #2d2d2d;
        }

        .gen-btn.gen-btn-outline {
            border: solid 1px #e6e7e8;
            color: var(--text-color-1);
            padding: 10px 20px 11px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 500;
            transition: all 0.25s;
            background: transparent;
        }

        .cancel-btn {
            background: #e6e7e8;
            border-color: #e6e7e8;
        }

        .gen-btn.delete-btn {
            background: #ff3a29;
            border-color: #ff3a29;
            color: #fff;
        }


        /*MODAL STYLES*/
        /*GENERAL STYLING*/
        .gen-input {
            border-radius: 5px;
            border: solid 1px #e6e7e8;
            background-color: #fdfdfd;
            height: 40px;
            outline: none;
            box-shadow: none;
            font-size: 14px;
            color: var(--text-color-2);
            font-weight: 500;
            width: 100%;
            padding: 5px 15px;
            outline: none !important;
            box-shadow: none !important;
        }

        textarea.gen-input {
            height: 137px;
            resize: none;
            padding: 10px 15px;
            outline: none !important;
            box-shadow: none !important;
        }

        select.gen-input {
            padding: 5px 15px 5px 5px;
        }

        .gen-input:active,
        .gen-input:focus {
            border-color: var(--primary-color);
        }

        .y-center {
            display: flex;
            align-items: center;
        }

        .gen-btn {
            border: solid 1px #e6e7e8;
            color: var(--text-color-1);
            padding: 10px 20px 11px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 500;
            transition: all 0.25s;
            background: var(--primary-color);
            border-color: var(--primary-color);
        }

        .gen-btn:hover, .gen-btn.gen-btn-outline:hover {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: var(--text-color-1);
        }

        .gen-btn.gen-btn-outline {
            border: solid 1px #e6e7e8;
            color: var(--text-color-1);
            padding: 10px 20px 11px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 500;
            transition: all 0.25s;
            background: transparent;
        }

        .cancel-btn {
            background: #e6e7e8;
            border-color: #e6e7e8;
        }

        .gen-btn.delete-btn {
            background: #ff3a29;
            border-color: #ff3a29;
            color: #fff;
        }

        .mw-490 {
            max-width: 490px;
        }

        .m-0-auto {
            margin: 0 auto;
        }

        .gen-modal .modal-dialog {
            max-width: 726px;
            width: 100%;
        }

        .gen-modal .modal-header {
            padding: 18px 30px;
            justify-content: center;
        }

        .gen-modal .modal-header .btn-close {
            position: absolute;
            right: 30px;
            outline: none;
            box-shadow: none;
        }

        .gen-modal .modal-body {
            padding: 30px;
        }

        .gen-modal .modal-footer {
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .gen-modal .modal-footer:before,
        .gen-modal .modal-footer:after {
            display: none;
        }

        .gen-modal .modal-footer .modal-cancel-btn {
            border: solid 1px transparent;
            color: var(--text-color-2);
            padding: 10px 20px 11px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 500;
            transition: all 0.25s;
            background: transparent;
        }

        .gen-modal .modal-footer .modal-cancel-btn:hover {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: var(--text-color-1);
        }

        .gen-modal .form-group {
            margin-bottom: 20px;
        }

        .gen-modal .form-group label {
            font-size: 14px;
            line-height: 1;
            font-weight: 700;
            color: var(--text-color-1);
            margin-bottom: 10px;
        }

        .gen-modal .modal-body {
            padding: 30px 40px;
        }

        :root {
            --primary-color: #ffcd05;
            --text-color-1: #2d2d2d;
            --text-color-2: #000000;
            --text-color-3: #676767;
            --text-color-4: #a2a7a5;
            --bg-color-1: #ffffff;
        }

        .new-service-modal-top .img {
            width: 170px;
            height: 170px;
            border-radius: 8px;
            background-color: #e6e7e8;
            position: relative;
        }

        .new-service-modal-top .img input {
            position: absolute;
            top: 0;
            left: 0;
            height: 170px;
            width: 170px;
            opacity: 0;
        }

        body {
            font-family: 'Manrope', sans-serif;
        }

        .modal-title {
            margin-bottom: 0;
            line-height: 1.5;
            font-size: 20px;
            color: #000;
            font-weight: 500;
            text-align: center;
        }

        .gen-modal .modal-header {
            position: relative;
        }

        .gen-modal .modal-header .btn-close {
            position: absolute;
            right: 30px;
            outline: none;
            box-shadow: none;
            background-color: transparent;
            color: #000;
            border: none;
            width: 25px;
            height: 25px;
        }

        .gen-modal .modal-header .btn-close:before {
            content: "\f00d";
            font-family: FontAwesome;
            font-style: normal;
            font-weight: normal;
            text-decoration: inherit;
            color: #000;
            font-size: 18px;
            /* padding-right: 0.5em; */
            position: absolute;
            top: -28px;
            right: 0;
        }

        .mb-0 {
            margin-bottom: 0 !important;
        }

        .d-flex {
            display: flex !important;
        }

        .align-items-center {
            align-items: center !important;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 36px;
            height: 20px;
            margin-bottom: 0 !important;
            margin-right: 5px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .switch .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .switch .slider:before {
            position: absolute;
            content: "";
            height: 15px;
            width: 15px;
            left: 4px;
            bottom: 2.5px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .switch input:checked + .slider {
            background-color: #33ac2e;
        }

        .switch input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        .switch input:checked + .slider:before {
            -webkit-transform: translateX(12px);
            -ms-transform: translateX(12px);
            transform: translateX(12px);
        }

        /* Rounded sliders */
        .switch .slider.round {
            border-radius: 34px;
        }

        .switch .slider.round:before {
            border-radius: 50%;
        }

        .service-menu-card-2 .text .info-list {
            padding-left: 15px;
        }

        .service-menu-card-2 .text .info-list li:before {
            display: none;
        }

        .service-menu-card-2 .text .info-list li {
            margin-right: 20px;
            padding: 5px 5px 5px 0;
        }

        .col-12 {
            position: relative;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
        }

        .avatar-upload {
            position: relative;
            margin: 0 0 0px 0;
            display: flex;
            align-items: center;
            overflow: hidden;
        }

        .avatar-upload .tag {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 14px;
            color: #282828;
            font-weight: 500;
            width: 100%;
            text-align: center;
            padding: 0 10px;
        }

        .mr-1 {
            margin-right: 1rem;
        }

        .avatar-upload .avatar-edit {
            z-index: 1;
            position: absolute;
            top: 0;
            left: 0;
            width: 170px;
            height: 170px;
        }

        .avatar-upload .avatar-edit input {
            opacity: 0;
            position: absolute;
            top: 0;
            left: 0;
            width: 170px;
            height: 170px;
            cursor: pointer;
        }

        .avatar-upload .avatar-edit input + label {
            display: inline-block;
            margin-bottom: 0;
            border-radius: 100%;
            color: #000000;
            font-size: 16px;
            border: none;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.2s ease-in-out;
            display: flex;
            align-items: center;
            justify-content: center;
            white-space: nowrap;
            cursor: pointer;
        }

        .avatar-upload .avatar-edit input + label i {
            color: #646D7B;
        }

        .avatar-upload .avatar-preview {
            width: 170px;
            height: 170px;
            position: relative;
            border: none;
        }

        .avatar-upload .avatar-preview > div {
            width: 100%;
            height: 100%;
            border-radius: 0;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .gen-modal .form-group label.switch ~ label {
            line-height: 2;
        }

        .gen-light-text {
            font-size: 14px !important;
            font-weight: 400 !important;
            line-height: 1.5 !important;
            color: #676767 !important;
        }
    </style>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet">
@endpush
@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="container">
                    <div class="service-menu-card-wrap">
                        {{--<div class="service-menu-card service-menu-card-1">--}}
                        {{--<div class="text">--}}
                        {{--<p class="title">Publish Changes</p>--}}
                        {{--<p>These can be instructions to publish changes</p>--}}
                        {{--</div>--}}
                        {{--<div class="button-box">--}}
                        {{--<a href="#!" class="gen-btn"><i class="fas fa-upload"></i>Publish changes</a>--}}
                        {{--</div>--}}
                        {{--</div>--}}

                        <div class="service-menu-card service-menu-card-2">
                            <div class="img" style="background: none !important;">
                                <img src="{{ $petspace['image_url'] }}" alt="icon" class="img-fluid"
                                     style="width: 300px;border-radius: 13px;">
                            </div>
                            <div class="text">
                                <p class="title">{{$petspace['name']}}</p>
                                <p>{{$petspace['grooming_text']}}</p>
                                <ul class="info-list">
                                    <li>{{$petspace['rating']}} <i class="fas fa-star"></i> (200) <img
                                                src="{{ url('public/assets/images/google-icon.png') }}" alt="icon"
                                                class="img-fluid"></li>
                                    @if($petspace['min_order'] != 0 )
                                        <li>AED {{$petspace['min_order']}}</li>
                                    @endif
                                    <li>{{$petspace['delivery_text']}}</li>
                                </ul>
                                <p class="sub-text">{{$petspace['pick_drop_text']}}</p>
                            </div>
                        </div>

                        @foreach($categories as $category)
                            <div class="service-menu-card service-menu-card-1 full-text">
                                <div class="text">
                                    <p class="title">{{$category['name']}}<a class="btn-edit-category"
                                                                             data-id="{{$category['id']}}"
                                                                             style="cursor: pointer;"><i
                                                    class="fas fa-pencil-alt"></i></a>
                                    </p>
                                    <p>{{$category['description']}}</p>
                                </div>
                            </div>

                            @foreach($category['service'] as $service)
                                <div class="service-menu-card service-menu-card-3">
                                    <div class="top">
                                        <div class="text">
                                            <p class="name">{{$service['name']}}<a class="btn-edit-service"
                                                                                   data-id="{{$service['id']}}"
                                                                                   style="cursor: pointer;"><i
                                                            class="fas fa-pencil-alt"></i></a></p>
                                            <p>{{$service['description']}}</p>
                                            @if($service['discount'] > 0 )
                                                <p class="price">
                                                    AED {{$service['price'] - (($service['discount'] /100) * $service['price'])}}
                                                    <span class="cut-price">{{ "AED ".$service['price']}} </span>•
                                                    Duration: {{$service['service_duration']}}mins</p>
                                            @else
                                                <p class="price">
                                                    AED {{$service['price']}} •
                                                    Duration: {{$service['service_duration']}}mins</p>
                                            @endif

                                            <a href="{{url('admin/petspaces/service-submenu').'/'.$service['id']}}"
                                               class="sub-menu">View Submenu <i class="fas fa-arrow-right"></i></a>
                                        </div>
                                        <div class="img">
                                            <img src="{{ $service['image_url'] }}" alt="icon" class="img-fluid"
                                                 style="width: 105px; border-radius: 13px; height: 105px;">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="service-menu-card add-new-service">
                                <a class="add-btn btn-add-service" data-id="{{$category['id']}}"
                                   style="cursor: pointer"><i
                                            class="fas fa-plus mr-1"></i>New Service</a>
                            </div>
                        @endforeach


                        <div class="service-menu-card add-service-category">
                            <a class="add-btn btn-add-category" style="cursor: pointer;"><i
                                        class="fas fa-plus mr-1"></i>ADD A NEW CATEGORY
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade gen-modal technician-modal" id="addNewCategory" tabindex="-1" aria-hidden="true">
    </div>

    <div class="modal fade gen-modal technician-modal" id="addNewService" tabindex="-1" aria-hidden="true">
    </div>

    <div class="modal fade gen-modal technician-modal" id="editNewCategory" tabindex="-1" aria-hidden="true">
    </div>

    <div class="modal fade gen-modal technician-modal" id="editNewService" tabindex="-1" aria-hidden="true">
    </div>
@endsection
@push('scripts')
    {{--<script src="{{ url('public/assets/js/custom.js') }}"></script>--}}
    <script>


        $('body').on('click', '.btn-add-cancel', function () {
            $('.technician-modal').modal('hide');
        });

        function ajaxPost(url, data, callback, formdata = true) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            if (formdata) {
                $.ajax({
                    method: "POST",
                    url: url,
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    beforeSend: function () {
                        $('body .spinner').css('display', 'block');
                    },
                    success: function (rdata) {
                        $('.spinner').css('display', 'none');
                        callback(true, rdata)
                    }, error: function (edata) {
                        $('.spinner').css('display', 'none');
                        callback(false, edata)
                    }
                });
            } else {
                $.ajax({
                    method: "POST",
                    url: url,
                    data: data,
                    cache: false,
                    dataType: 'json',
                    success: function (rdata) {
                        callback(true, rdata)
                    }, error: function (edata) {
                        callback(false, edata)

                    }
                });
            }

        }

        function ajaxGet(url, queryParam, callback) {
            $.ajax({
                method: "GET",
                url: url,
                data: queryParam,
                dataType: 'json',
                success: function (rdata) {
                    callback(true, rdata)
                }, error: function (edata) {

                    callback(false, edata)

                }
            });
        }

        function defaultFormat(state) {
            return state.text;
        }

        $('.select2').each(function () {
            var format = $(this).data('format') ? $(this).data('format') : "defaultFormat";
            $(this).select2({
                theme: "bootstrap",
                templateResult: window[format],
                templateSelection: window[format],
                escapeMarkup: function (m) {
                    return m;
                }
            });
        });

        function goBack() {
            window.history.back(function () {
                location.reload();
            });
        }


        $(".btn-add-category").click(function () {

            var url = "{{url('admin/petspaces/add-category-modal').'/'.$petspace['id']}}";
            ajaxGet(url, "", (status, data) => {
                if (status) {

                    $("#addNewCategory").html(data.data);
                    $('#addNewCategory').modal('show');
                }
            });
        });

        $(".btn-add-service").click(function () {

            var catId = $(this).data('id');
            // $('#passenger-added-alert').css('display', 'none');
            var url = "{{url('admin/petspaces/add-service-modal').'/'}}" + catId;
            ajaxGet(url, "", (status, data) => {
                if (status) {

                    $("#addNewService").html(data.data);
                    $('#addNewService').modal('show');
                }
            });

        });

        $(".btn-edit-category").click(function () {

            var catId = $(this).data('id');
            // $('#passenger-added-alert').css('display', 'none');
            var url = "{{url('admin/petspaces/edit-category-modal').'/'}}" + catId;
            ajaxGet(url, "", (status, data) => {
                if (status) {

                    $("#editNewCategory").html(data.data);
                    $('#editNewCategory').modal('show');
                }
            });

        });

        $(".btn-edit-service").click(function () {

            var catId = $(this).data('id');
            // $('#passenger-added-alert').css('display', 'none');
            var url = "{{url('admin/petspaces/edit-service-modal').'/'}}" + catId;
            ajaxGet(url, "", (status, data) => {
                if (status) {
                    $("#editNewService").html(data.data);
                    $('#editNewService').modal('show');
                }
            });

        });

        $('body').on('submit', '#menu-form', function (e) {

            e.preventDefault();
            var that = $(this);
            var url = $(this).attr('action');
            var method = $(this).attr('method');
            var form_data = new FormData($(this)[0]);
            ajaxPost(url, form_data, (status, data) => {
                if (status) {

                    // $('#passenger-added-alert').css('display', 'block');
                    // $('#passenger-added-alert').removeClass('alert-danger');
                    // $('#passenger-added-alert').addClass('alert-success');
                    // $('#passenger-added-alert').html(data.message);
                    $('body #addNewService').modal('hide');
                    location.reload();
                    // reservation_datatables.row.add([data.data.name, data.data.pnr, data.data.age_group, data.data.service, data.data.phone, data.data.type, data.data.issuer_name, data.data.card_number, '<button type="button" data-id="' + (data.data.index - 1) + '" class="btn passenger-delete"><i class="fas fa-times-circle"></i></button>']);
                    // reservation_datatables.draw();


                } else {

                    $('#modal-response-alert').css('display', 'block');
                    $('#modal-response-alert').removeClass('d-none');
                    $('#modal-response-alert').removeClass('alert-success');
                    $('#modal-response-alert').addClass('alert-danger');

                    $('#modal-response-alert').html(data.responseJSON.message);

                    $('#modal-response-alert')[0].scrollIntoView({behavior: "smooth"});
                    // $('html,body').animate({
                    //     scrollTop: $("#response-alert").offset().top - 500
                    // }, 'slow');

                }
            });
        });

    </script>
@endpush