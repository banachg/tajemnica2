<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <form class="row row-cols-lg-auto g-3 align-items-center">
            <div class="col-12">
                <label class="visually-hidden" for="qtyPiki">Piki</label>
                <div class="input-group">
                    <div class="input-group-text">Piki</div>
                    <input type="text" class="form-control" id="qtyPiki" placeholder="ilość">
                </div>
            </div>

            <div class="col-12">
                <label class="visually-hidden" for="inlineFormSelectPref">Opcja zbieraka</label>
                <select class="form-select" id="opcjaZbieraka">
                    <option selected>Wybierz...</option>
                    <option value="123">1+2+3</option>
                    <option value="23">2+3</option>
                    <option value="234">2+3+4</option>
                    <option value="1234">1+2+3+4</option>
                </select>
            </div>
        </form>
    </div>
    <div class="row">
        Zebrane surowce: <span id="zebraneSurowce">0</span>
    </div>
    <div class="row">
        Czas zbierania: <span id="czasZbierania">0</span>
    </div>
    <div class="row">
        Sura na godzine: <span id="suraNaGodzine">0</span>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="{{asset('js\tajemnica.js')}}"></script>
</body>
</html>
