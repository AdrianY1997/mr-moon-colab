<div class="dash dash-info">
    <div>
        <div class="container">
            @include('dashboard/static/menu'):
            <div class="content">
                <div class="sections">
                    <p style="cursor: pointer" class="active text-black" data-section="0">Ver Información</p>
                    <p style="cursor: default" data-section="1">Editar</p>
                </div>
                <div class="get-info show" data-section="0">
                    <p class="m-0">Datos del sitio web</p>
                    <div class="web-data">
                        <div class="logo">
                            @php
                            echo $webdata->webd_logo ? "<img class=\"show\" width=\"150px\" src=\"" . asset($webdata->webd_logo) . "\" alt=\"\">" : "<p class=\"show\" style=\"width:150px;height:150px;display:flex;justify-content:center;align-items:center;box-shadow:0 0 5px 0 lightgrey\">NO IMAGE</p>";
                            @endphp
                        </div>
                        <div>
                            <div class="info-control">
                                <p class="m-0"><span><i class="fa-solid fa-file-signature"></i></span>
                                    {{ $webdata->webd_name }}
                                </p>
                            </div>
                            <div class="info-control">
                                <p class="m-0"><span><i class="fa-solid fa-closed-captioning"></i></span>
                                    {{ $webdata->webd_subt }}
                                </p>
                            </div>
                            <div class="info-control">
                                <p class="m-0"><span><i class="fa-regular fa-star"></i></span>
                                    {{ explode('/', $webdata->webd_logo)[2] }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <p class="m-0">Datos de contacto</p>
                    <div class="info-control">
                        <p class="m-0"><span><i class="fa-solid fa-at"></i></span>
                            {{ $webdata->webd_email }}
                        </p>
                    </div>
                    <div class="info-control">
                        <p class="m-0"><span><i class="fa-solid fa-phone"></i></span>
                            {{ $webdata->webd_phone }}
                        </p>
                    </div>
                    <div class="info-control">
                        <p class="m-0"><span><i class="fa-solid fa-location-dot"></i></span>
                            {{ $webdata->webd_address }}
                        </p>
                    </div>
                    <div class="info-control">
                        <p class="m-0"><span><i class="fa-solid fa-earth-americas"></i></span>
                            {{ $webdata->webd_city }}
                        </p>
                    </div>
                    <hr>
                    <p class="m-0">Redes sociales</p>
                    <div class="info-control">
                        <p class="m-0"><span><i class="fa-brands fa-facebook"></i></span>
                            {{ $webdata->webd_fblink }}
                        </p>
                    </div>
                    <div class="info-control">
                        <p class="m-0"><span><i class="fa-brands fa-twitter"></i></span>
                            {{ $webdata->webd_twlink }}
                        </p>
                    </div>
                    <div class="info-control">
                        <p class="m-0"><span><i class="fa-brands fa-instagram"></i></span>
                            {{ $webdata->webd_iglink }}
                        </p>
                    </div>
                    <div class="info-control">
                        <p class="m-0"><span><i class="fa-brands fa-youtube"></i></span>
                            {{ $webdata->webd_ytlink }}
                        </p>
                    </div>
                </div>
                <form class="set-info hide" data-section="1" method="post" action="{{ route('dashboard/updateWebInfo') }}">
                    <p class="m-0">Datos del sitio web</p>
                    <div class="web-data">
                        <div class="logo">
                        @if($webdata->webd_logo):
                            <img class="show" width="150px" src="{{ asset($webdata->webd_logo) }}" alt="">
                        @else
                            <p class="show" style="width:150px;height:150px;display:flex;justify-content:center;align-items:center;box-shadow:0 0 5px 0 lightgrey">NO IMAGE</p>
                        @endif
                        </div>
                        <div>
                            <div class="form-control">
                                <label><i class="fa-solid fa-file-signature"></i></label>
                                <input name="name" type="text" value="{{ $webdata->webd_name }}">
                            </div>
                            <div class="form-control">
                                <label><i class="fa-solid fa-closed-captioning"></i></label>
                                <input name="subt" type="text" value="{{ $webdata->webd_subt }}">
                            </div>
                            <div class="form-control">
                                <label><i class="fa-regular fa-star"></i></label>
                                <input name="photo" type="file">
                            </div>
                        </div>
                    </div>

                    <hr>
                    <p class="m-0">Datos de contacto</p>
                    <div class="form-control">
                        <label><i class="fa-solid fa-at"></i></label>
                        <input name="email" type="text" value="{{ $webdata->webd_email }}">
                    </div>
                    <div class="form-control">
                        <label><i class="fa-solid fa-phone"></i></label>
                        <input name="phone" type="text" value="{{ $webdata->webd_phone }}">
                    </div>
                    <div class="form-control">
                        <label><i class="fa-solid fa-location-dot"></i></label>
                        <input name="address" type="text" value="{{ $webdata->webd_address }}">
                    </div>
                    <div class="form-control">
                        <label><i class="fa-solid fa-earth-americas"></i></label>
                        <input name="city" type="text" value="{{ $webdata->webd_city }}">
                    </div>
                    <hr>
                    <p class="m-0">Redes sociales</p>
                    <div class="form-control">
                        <label><i class="fa-brands fa-facebook"></i></label>
                        <input name="fblink" type="text" value="{{ $webdata->webd_fblink }}">
                    </div>
                    <div class="form-control">
                        <label><i class="fa-brands fa-twitter"></i></label>
                        <input name="twlink" type="text" value="{{ $webdata->webd_twlink }}">
                    </div>
                    <div class="form-control">
                        <label><i class="fa-brands fa-instagram"></i></label>
                        <input name="iglink" type="text" value="{{ $webdata->webd_iglink }}">
                    </div>
                    <div class="form-control">
                        <label><i class="fa-brands fa-youtube"></i></label>
                        <input name="ytlink" type="text" value="{{ $webdata->webd_ytlink }}">
                    </div>
                    <hr>
                    <div>
                        <div class="reverse">
                            <div class="form-control">
                                <label><i class="fa-solid fa-key"></i></label>
                                <input name="password" type="password" placeholder="Contraseña">
                            </div>
                            <div>
                                <button>Enviar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script defer src="https://cdn.crop.guide/loader/l.js?c=123ABC"></script>
