<script>
    var drop = new Dropzone('#file', {
        createImageThumbnails: false,
        addRemoveLinks: true,
        url: '{{route('upload.store',$file)}}',
        headers: {
            'x-csrf-token': document.querySelectorAll('meta[name=csrf-token]')[0].getAttributeNode('content').value,
        }
    });


    @foreach($file->uploads as $upload)
    drop.emit('addedfile', {
        id: '{{$upload->id}}',
        name: '{{$upload->filename}}',
        size: '{{$upload->size}}'
    })
    @endforeach
    drop.on('success', function (file, response) {
        file.id = response.id
    })

    drop.on('removedfile', function (file) {
        axios.delete('/{{$file->identifier}}/upload/' + file.id).catch(function (error) {
            drop.emit('addedFile', {
                id: file.id,
                name: file.name,
                size: file.size
            })
        })
    })
</script>