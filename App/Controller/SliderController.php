<?php


namespace App\Controller;


use App\Models\Slider;
use Core\FileService;
use Core\Validation;


class SliderController
{
    private FileService $fileService;


    public function __construct()
    {
        $this->fileService = new FileService();
    }


    public function index()
    {
        $sliderModel = new Slider();
        $slider = $sliderModel->first();
        return view('admin/slider',compact('slider'));
    }

    public function store()
    {
        $sliderModel = new Slider();
        $title = htmlentities(postData('title'),ENT_QUOTES);
        $text = htmlentities(postData('text'),ENT_QUOTES);
        $vld = new Validation();
        $vld->validateLengthText($title,$text,255);
        $vld->hasData($title,$text);

;


        $slider = $sliderModel->first();

        $data = [
            'title' => $title,
            'text' => $text,

        ];


        if($this->fileService->hasFile('image')){
            if(!$this->fileService->validateType('image',['jpeg','jpg','png'])){
                throw new \Exception('File type incorrect');
            }
            $fileName = $this->fileService->upload('image');
            $data['image'] = $fileName;
        }

        if(!$slider){
            $sliderModel->create($data);

        }else{
            if($this->fileService->hasFile('image')){
                $this->fileService->delete($slider->image);
            }else{
                $data['image'] = $slider->image;
            }



            $sliderModel->where('id',$slider->id)->update($data);
        }

       return redirect(url('/admin/slider'),true);
    }
}