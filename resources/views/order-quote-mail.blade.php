<h1>Email: {{ $email }}</h1>
<h1>Phone Number: {{ $phoneNumber }}</h1>

<h1>Order Id: {{ $order->id }}</h1>

<h1>Products</h1>

@foreach($order->products as $product)
    <p>Id: {{ $product->id }}</p>
    <p>Name: {{ $product->name }}</p>
    <p>Description: {{ $product->description }}</p>
    <p>Price: {{ $product->price }}</p>
    <p>Type: {{ $product->type }}</p>
@endforeach

<h1>Boiler</h1>
<p>Title: {{ $order->boiler->title }}</p>
<p>Description: {{ $order->boiler->description }}</p>
<p>Price: {{ $order->boiler->price }}</p>
<p>Additional Info: {{ $order->boiler->additional_info }}</p>
<p>Old Price: {{ $order->boiler->old_price }}</p>
<p>Radiators Count: {{ $order->boiler->radiators_count }}</p>
<p>Hot Water Flow Rate: {{ $order->boiler->hot_water_flow_rate }}</p>
<p>Heating Output: {{ $order->boiler->heating_output }}</p>
<p>Warranty: {{ $order->boiler->warranty }}</p>
<p>Efficiency: {{ $order->boiler->efficiency }}</p>
<p>Height: {{ $order->boiler->height }}</p>
<p>Width: {{ $order->boiler->width }}</p>
<p>Depth: {{ $order->boiler->depth }}</p>
<p>Hydrogen Blend: {{ $order->boiler->hydrogen_blend }}</p>
<p>Best Seller: {{ $order->boiler->best_seller }}</p>
