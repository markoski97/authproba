<section class="hero is-primary">
    <div class="hero-body">
        <div class="level">
        {{--    VREDNISTITE NA VARIABLITE IDATA OD AccountStatsComposer--}}
            <div class="level-item has-text-centered">
                <div>
                    <p class="heading">Files</p>
                    <p class="title">{{$fileCount}}</p>
                </div>
            </div>

            <div class="level-item has-text-centered">
                <div>
                    <p class="heading">Sales</p>
                    <p class="title">{{$saleCount}}</p>
                </div>
            </div>


            <div class="level-item has-text-centered">
                <div>
                    <p class="heading">Sales this mouth</p>
                    <p class="title">{{$mouthtimeEarned}} $</p>
                </div>
            </div>

            <div class="level-item has-text-centered">
                <div>
                    <p class="heading">Lifetime sales</p>
                    <p class="title">${{$lifetimeEarned}}</p>
                </div>
            </div>

        </div>
    </div>

</section>