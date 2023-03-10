{{-- <footer class="footer">
    <div class="container-fluid">
        <div class="row text-muted">
            <div class="col-6 text-start">
                <p class="mb-0">
                    <a class="text-muted" href="https://shivpatel.netlify.app/" target="_blank"><strong>Shiv Patel</strong></a> &copy;
                </p>
            </div>
            <div class="col-6 text-end">
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a class="text-muted" href="#" target="_blank">Support</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="text-muted" href="#" target="_blank">Help Center</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="text-muted" href="#" target="_blank">Privacy</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="text-muted" href="#" target="_blank">Terms</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer> --}}


<footer class="footer">
    <div class="container-fluid">
        <div class="row text-muted">
            <div class="col-6 text-start">
                <p class="mb-0">
                    <a class="text-muted" href="https://shivpatel.netlify.app/" target="_blank"><strong>Shiv Patel</strong></a> &copy;
                </p>
            </div>
            <div class="col-6 text-end">
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a class="text-muted" href="#" target="_blank">Support</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="text-muted" href="#" target="_blank">Help Center</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="text-muted" href="#" target="_blank">Privacy</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="text-muted" href="#" target="_blank">Terms</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<script src="js/app.js"></script>
<script src="//cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js">
let table = new DataTable('#myTable');
</script>
<script>$(document).ready(function () {
  $('#userData').DataTable({
    order: [[5, 'desc']],
    "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
    "pageLength": 5
  });
});</script>

</body>

</html>