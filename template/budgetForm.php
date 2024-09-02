<div class="mb-3">
    <label for="in_out" class="form-label">Income/Expense</label>
    <select id="in_out" name="in_out" class="form-select">
        <option value=1>Income</option>
        <option selected value=0>Expense</option>
    </select>
</div>
<!-- <div class="mb-3">
    <label for="daterange" class="form-label">Date and Time</label>
    <input id="daterange" type="text" value="" required class="form-control"/>
</div> -->
<div class="mb-3">
    <label for="datetime" class="form-label">Date and Time</label>
    <input id="datetime" type="datetime-local" name="datetime" value="" required class="form-control"/>
</div>
<div class="mb-3">
    <label for="account" class="form-label">Account</label>
    <select id="account" name="account" class="form-select" required></select>    
</div>
<div class="mb-3">
    <label for="category" class="form-label">Category</label>
    <select id="category" name="category" class="form-select" required></select>   
</div>
<div class="mb-3">
    <label for="amount" class="form-label">Amount</label>
    <div class="input-group mb-3">
        <span class="input-group-text">$</span>
        <input type="number" class="form-control" id="amount" name="amount" required min="0" step="0.01" value="0.00">
    </div>
</div>
<div class="mb-3">
  <label for="note" class="form-label">Note</label>
  <input class="form-control" id="note" name="note" type="text" minlength="2" maxlength="20">
</div>
<div class="mb-3">
  <label for="desc" class="form-label">Description</label>
  <textarea class="form-control" id="desc" name="desc" type="text" minlength="2" maxlength="255" rows="3"></textarea>
</div>
<div class="mb-3">
  <label for="attachment" class="form-label">Attachment</label>
  <input class="form-control" type="file" id="attachment" name="attachment">
</div>

<script>
    $(document).ready(function() {
        //get accounts
        $.ajax({
            url: 'requestHandler.php?action=getAccount',
            method: 'GET',
            dataType: 'json',
            success: function(data)  {
                var $select = $('#account');
                $select.empty(); // Clear previous options
                if (data.error) {
                    console.error('Error:', data.error);
                } else {
                    $select.append('<option value="">Select an account</option>');
                    $.each(data, function(index, option) {
                        $select.append('<option value="' + option.id + '">' + option.name + '</option>');
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Failed to fetch data:', textStatus, errorThrown);
            }
        });

        // //datetime picker
        // $(function() {
        //     $('#daterange').daterangepicker({
        //         timePicker: true,
        //         singleDatePicker: true,
        //         showDropdowns: true,
        //         startDate: moment(),
        //         // autoApply: true,
        //         // opens: center,
        //         locale: {
        //             format: 'MMMM D, YYYY hh:mm A'
        //         }
        //     });
        // });

        // $('#daterange').on('apply.daterangepicker', function(ev, picker) {
        //     var date = picker.startDate.format('YYYY-MM-DD') + 'T' + picker.startDate.format('hh:mm');
        //     $('#datetime').val(date);
        // });

        // $('#daterange').change(function(ev, picker) {
        //     var date = picker.startDate.format('YYYY-MM-DD') + 'T' + picker.startDate.format('hh:mm');
        //     $('#datetime').val(date);
        // });
    })
</script>