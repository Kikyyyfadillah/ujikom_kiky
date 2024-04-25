@extends('template/layout')

@push('style')
<!-- drng -->

@section('content')
<style>
    /* Gaya global */
     main {
        padding: 20px;
        display: flex;
        justify-content: center;
         Elemen di tengah */
    } 
    
    /* Gaya untuk kontainer */
     .container {
        width: 800px; */
    Lebar kontainer
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    } 

    /* Gaya untuk foto */ 
     .photo {
        display: flex;
        justify-content: center;
        margin-bottom: 10px;
        /* Margin bawah untuk jarak dengan elemen lain */
    } 

    .photo img {
        width: 10%;
        Lebar penuh sesuai kontainer 
        border-radius: 8px; */
        Tepi melengkung */
     }

    /* Gaya untuk formulir kontak */
    form {
        display: flex;
        flex-direction: column;
    } 

    form label {
        margin-bottom: 5px;
        font-weight: bold;
    } 

    form input,
    form textarea {
        padding: 10px;
        margin-bottom: 10px; 
         Margin seragam 
        border: 1px solid #ccc;
        border-radius: 4px; 
    } 

    form input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 10px;
        border-radius: 4px;
        cursor: pointer;
        font-weight: bold; 
     } 

    form input[type="submit"]:hover {
        background-color: #45a049;
    } 

    /* Gaya untuk peta */
    .map iframe {
        width: 100%;
        Lebar penuh sesuai kontainer
        height: 300px;
        border: 1px solid #ccc;
        border-radius: 8px;
     }  
</style>
@endpush

@section('content')
<main id="main" class="main">
    <div class="container">
        <!-- Foto -->
        <div class="photo">
            <img src="{{ asset('images/et al.jpg') }}" alt="Deskripsi gambar">
        </div>

        <!-- Formulir Kontak -->
        <div>
            <h2>Contact Us</h2>
            <form action="/submit-form" method="post">
                @csrf
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone">

                <label for="message">Message:</label>
                <textarea id="message" name="message" required></textarea>

                <input type="submit" value="Submit">
            </form>
        </div>

        <!-- Informasi Kontak -->
        <div>
            <h2>Contact Information</h2>
            <p><strong>Alamat:</strong> Jl. Caringin, Mekarsari, Kec. Cianjur, Kabupaten Cianjur, Jawa Barat 43211</p>
            <p><strong>Telepon:</strong> 085710222926</p>
        </div>

        <!-- Peta -->
        <div class="map">
            <h2>Our Location</h2>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31692.826521781157!2d107.07783531083984!3d-6.8180064000000025!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6853cc728e9a47%3A0xdf6b6b9da41fbea9!2set%20al%20Coffee%20Cianjur!5e0!3m2!1sid!2sid!4v1713843124547!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</main>
@endsection