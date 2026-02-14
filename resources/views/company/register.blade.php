<h2>Company Registration</h2>

<form action="{{ route('company.store') }}" method="POST">
    @csrf

    <label>Company Name</label>
    <input type="text" name="company_name" required>
    <br>

    <label>Contact Person</label>
    <input type="text" name="contact_person" required>
    <br>

    <label>Phone</label>
    <input type="text" name="phone" required>
    <br>

    <label>Required Date</label>
    <input type="date" name="required_date" required>
    <br>

    <label>Required Manpower</label>
    <input type="number" name="required_manpower" min="1" required>
    <br>

    <button type="submit">Submit</button>
</form>

<a href="{{ route('home') }}">Back to Home</a>
