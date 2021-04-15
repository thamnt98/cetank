<?php

namespace App\Http\Controllers;

use App\Models\CrawalPost;
use Illuminate\Http\Request;
use App\Models\Section;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Category;

require(__DIR__ . '../../../Helper/CrawalData.php');

class CrawalPostController extends Controller
{
    public function crawalNewPostOfF319()
    {
        $curl = curl_init();
        $linkurl = 'http://f319.com/';
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_URL => $linkurl,
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36',
            CURLOPT_SSL_VERIFYPEER => false
        ));
        $resp = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($httpcode != 200) {
            return;
        }
        curl_close($curl);
        $dom = str_get_html($resp);
        $ol = array_slice($dom->find('.discussionListItems li'), 0, 16);
        $postArray = [];
        foreach ($ol as $key => $li) {
            $title = $li->find('.title .PreviewTooltip', 0);
            $postArray[$key] = [
                'title' => $title->plaintext,
                'title_link' => 'http://f319.com/' . $title->href
            ];
            $listPage = $li->find('.itemPageNav a');
            if (!count($listPage)) {
                $postArray[$key]['comment'] = null;
                $postArray[$key]['comment_link'] = null;
                continue;
            }
            $lastPageLink = end($listPage)->href;
            $lastPageLink = 'http://f319.com/' . $lastPageLink;
            $curl1 = curl_init();
            curl_setopt_array($curl1, array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_URL => $lastPageLink,
                CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36',
                CURLOPT_SSL_VERIFYPEER => false
            ));
            $resp1 = curl_exec($curl1);
            $httpcode1 = curl_getinfo($curl1, CURLINFO_HTTP_CODE);
            if ($httpcode1 != 200) {
                continue;
            }
            curl_close($curl1);
            $dom1 = str_get_html($resp1);
            $messageList = $dom1->find('#messageList .message');
            $lastMessage = end($messageList)->find('.messageContent blockquote', 0);
            $postArray[$key]['comment'] = $lastMessage->plaintext;
            $postArray[$key]['comment_link'] =  $lastPageLink . '#' . end($messageList)->id;
        }
        foreach ($postArray as $post) {
            $p = CrawalPost::where('title_link', $post['title_link'])->where('comment_link', $post['comment_link'])->get();
            if (!count($p)) {
                CrawalPost::create($post);
            }
        }
    }

    public function all()
    {
        $page_title = "All F319 Post";
        $post = CrawalPost::orderBy('created_at', 'desc')->get();
        $basic = Section::first();
        return view('crawal.list', compact(['page_title', 'post', 'basic']));
    }


    public function delete(Request $request)
    {
        $ids = explode('-', $request->ids);
        array_pop($ids);
        $posts = CrawalPost::whereIn('id', $ids)->delete();
        session()->flash('message', 'Post Deleted Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }

    public function createPost($id)
    {
        $data['category'] = Category::whereStatus(1)->get();
        $data['page_title'] = "Create New Post";
        $data['basic'] = Section::first();
        $data['post'] = CrawalPost::findOrFail($id);
        $data['role_id'] = Auth::guard('admin')->user()->role_id;
        return view('post.create', $data);
    }
}
