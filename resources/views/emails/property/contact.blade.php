<x-mail::message>
# Nouvelle demande de contact

Bonjour, 
{{$data['firstName']}} {{$data['lastName']}} vous contact pour le bien <a href="{{route('property.show', ['slug' => $property->getSlug(), 'property' => $property])}}">{{$property->title}}</a>

- Nom : {{$data['lastName']}}
- Prenom :  {{$data['firstName']}}
- Telephone : {{$data['phone']}}
- Email : {{$data['email']}}

# Message
{{$data['message']}}

</x-mail::message>
