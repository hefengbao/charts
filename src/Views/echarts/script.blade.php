<script type="text/javascript">
    function {{ $chart->id }}_create(data) {
        {{ $chart->id }}_rendered = true;
        document.getElementById("{{ $chart->id }}_loader").remove();
        window.{{ $chart->id }} = echarts.init(document.getElementById("{{ $chart->id }}"), '{{ $chart->theme }}').setOption({
            dataset: {
                source: data
            },
            {!! $chart->formatOptions() !!}
        });
    }
    @include('charts::init')
</script>