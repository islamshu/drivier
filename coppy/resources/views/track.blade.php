




@isset($onlineDrivers)
@foreach ($onlineDrivers as $driver)
    <div class="online">
        <h3>{{ $driver->fname . ' ' . $driver->lname}}</h3>
        <p>
            Lat : {{ $driver->driver_lat }} <br>
            Lng : {{ $driver->driver_lon }}
        </p>
    </div>
@endforeach
@endisset