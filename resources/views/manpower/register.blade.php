<h2>ODC Manpower Registration</h2>

<form action="{{ route('manpower.store') }}" method="POST">
    @csrf

    <label>Name</label>
    <input type="text" name="name" required>
    <br>

    <label>Phone</label>
    <input type="text" name="phone" required>
    <br>

    <label>Skills</label>
    <input type="text" name="skills">
    <br>

    <label>Available Date</label>
    <input type="date" name="available_date" required>
    <br>

    <button type="submit">Submit</button>
</form>

<a href="{{ route('home') }}">Back to Home</a>
