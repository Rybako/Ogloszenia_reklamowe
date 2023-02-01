<table>
  <thead>
    <tr>
      <th>Sender</th>
      <th>Message</th>
      <th>Listing Item</th>
      <th>Date</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($messages as $message)
      <tr>
        <td>{{ $message->sender->name }}</td>
        <td>{{ $message->body }}</td>
        <td>{{ $message->listingItem->title }}</td>
        <td>{{ $message->created_at }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
