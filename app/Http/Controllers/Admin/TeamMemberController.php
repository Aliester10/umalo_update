<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use App\Models\TeamMemberSocial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamMemberController extends Controller
{
    public function index()
    {
        $members = TeamMember::with('socials')->orderBy('order', 'asc')->get();
        return view('admin.team_members.index', compact('members'));
    }

    public function create()
    {
        return view('admin.team_members.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required',
            'position'   => 'required',
            'photo'      => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'description'=> 'nullable',
            'order'      => 'nullable|integer'
        ]);

        // ============================
        //  UPLOAD FOTO -> STORAGE
        // ============================
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $filename = time() . '_' . $request->photo->getClientOriginalName();
            $photoPath = $request->file('photo')->storeAs(
                'img/team_members',
                $filename,
                'public'
            );
        }

        // ============================
        //  SIMPAN TEAM MEMBER
        // ============================
        $member = TeamMember::create([
            'name'        => $request->name,
            'position'    => $request->position,
            'photo'       => $photoPath, // <— SIMPAN PATH STORAGE
            'description' => $request->description,
            'order'       => $request->order ?? 0,
        ]);

        // ============================
        //  SIMPAN SOCIAL MEDIA
        // ============================
        TeamMemberSocial::create([
            'team_member_id' => $member->id,
            'linkedin'  => $request->linkedin,
            'instagram' => $request->instagram,
            'github'    => $request->github,
            'youtube'   => $request->youtube,
            'facebook'  => $request->facebook,
        ]);

        return redirect()->route('admin.team.index')
            ->with('success', 'Team Member berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $member = TeamMember::with('socials')->findOrFail($id);
        return view('admin.team_members.edit', compact('member'));
    }

    public function update(Request $request, $id)
    {
        $member = TeamMember::findOrFail($id);

        $request->validate([
            'name'       => 'required',
            'position'   => 'required',
            'photo'      => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'description'=> 'nullable',
            'order'      => 'nullable|integer'
        ]);

        // ============================
        //  UPDATE FOTO
        // ============================
        $photoPath = $member->photo;
        
        if ($request->hasFile('photo')) {

            // Hapus foto lama
            if ($member->photo && Storage::disk('public')->exists($member->photo)) {
                Storage::disk('public')->delete($member->photo);
            }

            // Upload baru
            $filename = time() . '_' . $request->photo->getClientOriginalName();
            $photoPath = $request->file('photo')->storeAs(
                'img/team_members',
                $filename,
                'public'
            );
        }

        // Update data member
        $member->update([
            'name'        => $request->name,
            'position'    => $request->position,
            'photo'       => $photoPath,
            'description' => $request->description,
            'order'       => $request->order ?? 0,
        ]);

        // Update social media
        $member->socials()->update([
            'linkedin'  => $request->linkedin,
            'instagram' => $request->instagram,
            'github'    => $request->github,
            'youtube'   => $request->youtube,
            'facebook'  => $request->facebook,
        ]);

        return redirect()->route('admin.team.index')
            ->with('success', 'Data Berhasil Diperbarui!');
    }

    public function destroy($id)
    {
        $member = TeamMember::findOrFail($id);

        // Hapus foto
        if ($member->photo && Storage::disk('public')->exists($member->photo)) {
            Storage::disk('public')->delete($member->photo);
        }

        $member->delete();

        return redirect()->route('admin.team.index')
            ->with('success', 'Team Member Berhasil Dihapus!');
    }
}
