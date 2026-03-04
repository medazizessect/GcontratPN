
Private Sub Proc_2_0_4D3460(arg_C) '4D3460
  loc_004D3460: push ebp
  loc_004D3461: mov ebp, esp
  loc_004D3463: sub esp, 00000008h
  loc_004D3466: push 00401A96h ; __vbaExceptHandler
  loc_004D346B: mov eax, fs:[00000000h]
  loc_004D3471: push eax
  loc_004D3472: mov fs:[00000000h], esp
  loc_004D3479: sub esp, 00000088h
  loc_004D347F: push ebx
  loc_004D3480: push esi
  loc_004D3481: push edi
  loc_004D3482: mov var_8, esp
  loc_004D3485: mov var_4, 004012E0h
  loc_004D348C: xor eax, eax
  loc_004D348E: push 00495B1Ch
  loc_004D3493: mov var_14, eax
  loc_004D3496: mov var_84, eax
  loc_004D349C: call [004010BCh] ; __vbaNew
  loc_004D34A2: mov esi, arg_8
  loc_004D34A5: push eax
  loc_004D34A6: push esi
  loc_004D34A7: call [00401064h] ; __vbaVargObj
  loc_004D34AD: mov eax, [004E50A4h]
  loc_004D34B2: lea ecx, var_14
  loc_004D34B5: push eax
  loc_004D34B6: push ecx
  loc_004D34B7: call [0040106Ch] ; __vbaObjSetAddref
  loc_004D34BD: mov ecx, arg_C
  loc_004D34C0: lea edx, var_98
  loc_004D34C6: push edx
  loc_004D34C7: lea edi, var_14
  loc_004D34CA: mov ebx, 00004009h
  loc_004D34CF: mov var_54, 00000003h
  loc_004D34D6: call [00401080h] ; __vbaVargVar
  loc_004D34DC: mov edx, [eax]
  loc_004D34DE: sub esp, 00000010h
  loc_004D34E1: mov ecx, esp
  loc_004D34E3: sub esp, 00000010h
  loc_004D34E6: mov [ecx], edx
  loc_004D34E8: mov edx, [eax+00000004h]
  loc_004D34EB: mov [ecx+00000004h], edx
  loc_004D34EE: mov edx, [eax+00000008h]
  loc_004D34F1: mov eax, [eax+0000000Ch]
  loc_004D34F4: mov [ecx+00000008h], edx
  loc_004D34F7: mov edx, var_20
  loc_004D34FA: mov [ecx+0000000Ch], eax
  loc_004D34FD: mov ecx, esp
  loc_004D34FF: mov eax, var_18
  loc_004D3502: sub esp, 00000010h
  loc_004D3505: mov [ecx], ebx
  loc_004D3507: mov [ecx+00000004h], edx
  loc_004D350A: mov edx, var_30
  loc_004D350D: mov [ecx+00000008h], edi
  loc_004D3510: mov [ecx+0000000Ch], eax
  loc_004D3513: mov ecx, esp
  loc_004D3515: mov eax, 00000003h
  loc_004D351A: sub esp, 00000010h
  loc_004D351D: mov [ecx], eax
  loc_004D351F: mov [ecx+00000004h], edx
  loc_004D3522: mov edx, var_54
  loc_004D3525: mov [ecx+00000008h], eax
  loc_004D3528: mov eax, var_28
  loc_004D352B: mov [ecx+0000000Ch], eax
  loc_004D352E: mov eax, var_50
  loc_004D3531: mov ecx, esp
  loc_004D3533: push 00000004h
  loc_004D3535: push 00495B2Ch ; "Open"
  loc_004D353A: mov [ecx], edx
  loc_004D353C: mov edx, var_48
  loc_004D353F: mov [ecx+00000004h], eax
  loc_004D3542: mov eax, 00000003h
  loc_004D3547: mov [ecx+00000008h], eax
  loc_004D354A: mov [ecx+0000000Ch], edx
  loc_004D354D: mov edx, esi
  loc_004D354F: lea ecx, var_84
  loc_004D3555: call [00401014h] ; __vbaVarVargNofree
  loc_004D355B: push eax
  loc_004D355C: call [004010A4h] ; __vbaObjVar
  loc_004D3562: push eax
  loc_004D3563: call [00401144h] ; __vbaLateMemCall
  loc_004D3569: mov eax, var_14
  loc_004D356C: add esp, 0000004Ch
  loc_004D356F: push 00494E24h
  loc_004D3574: push eax
  loc_004D3575: call [0040116Ch] ; __vbaCastObj
  loc_004D357B: push eax
  loc_004D357C: push 004E50A4h
  loc_004D3581: call [00401060h] ; __vbaObjSet
  loc_004D3587: lea ecx, var_14
  loc_004D358A: call [00401188h] ; __vbaFreeObj
  loc_004D3590: push 004D35A2h
  loc_004D3595: jmp 004D35A1h
  loc_004D3597: lea ecx, var_14
  loc_004D359A: call [00401188h] ; __vbaFreeObj
  loc_004D35A0: ret
  loc_004D35A1: ret
  loc_004D35A2: mov ecx, var_10
  loc_004D35A5: pop edi
  loc_004D35A6: pop esi
  loc_004D35A7: mov fs:[00000000h], ecx
  loc_004D35AE: pop ebx
  loc_004D35AF: mov esp, ebp
  loc_004D35B1: pop ebp
  loc_004D35B2: retn 0008h
End Sub

Private Sub Proc_2_1_4D35C0() '4D35C0
  loc_004D35C0: push ebp
  loc_004D35C1: mov ebp, esp
  loc_004D35C3: sub esp, 00000008h
  loc_004D35C6: push 00401A96h ; __vbaExceptHandler
  loc_004D35CB: mov eax, fs:[00000000h]
  loc_004D35D1: push eax
  loc_004D35D2: mov fs:[00000000h], esp
  loc_004D35D9: sub esp, 00000054h
  loc_004D35DC: push ebx
  loc_004D35DD: push esi
  loc_004D35DE: push edi
  loc_004D35DF: mov var_8, esp
  loc_004D35E2: mov var_4, 004012F0h
  loc_004D35E9: mov eax, [004E50A4h]
  loc_004D35EE: xor edi, edi
  loc_004D35F0: lea edx, var_58
  loc_004D35F3: mov var_14, edi
  loc_004D35F6: mov var_24, edi
  loc_004D35F9: mov var_34, edi
  loc_004D35FC: mov var_44, edi
  loc_004D35FF: mov var_54, edi
  loc_004D3602: mov var_58, edi
  loc_004D3605: mov ecx, [eax]
  loc_004D3607: push edx
  loc_004D3608: push eax
  loc_004D3609: call [ecx+00000044h]
  loc_004D360C: cmp eax, edi
  loc_004D360E: fnclex
  loc_004D3610: jge 004D362Bh
  loc_004D3612: mov ecx, [004E50A4h]
  loc_004D3618: mov ebx, [00401048h] ; __vbaHresultCheckObj
  loc_004D361E: push 00000044h
  loc_004D3620: push 00494E44h
  loc_004D3625: push ecx
  loc_004D3626: push eax
  loc_004D3627: call ebx
  loc_004D3629: jmp 004D3631h
  loc_004D362B: mov ebx, [00401048h] ; __vbaHresultCheckObj
  loc_004D3631: lea edx, var_44
  loc_004D3634: push 004E5090h
  loc_004D3639: push edx
  loc_004D363A: mov var_3C, 004954B4h
  loc_004D3641: mov var_44, 00008008h
  loc_004D3648: call [0040109Ch] ; __vbaVarTstEq
  loc_004D364E: test ax, ax
  loc_004D3651: jz 004D386Eh
  loc_004D3657: cmp [004E52BCh], edi
  loc_004D365D: jnz 004D366Fh
  loc_004D365F: push 004E52BCh
  loc_004D3664: push 0048B4B4h
  loc_004D3669: call [00401100h] ; __vbaNew2
  loc_004D366F: mov esi, [004E52BCh]
  loc_004D3675: push 00495A80h ; "?????"
  loc_004D367A: push esi
  loc_004D367B: mov eax, [esi]
  loc_004D367D: call [eax+00000054h]
  loc_004D3680: cmp eax, edi
  loc_004D3682: fnclex
  loc_004D3684: jge 004D3691h
  loc_004D3686: push 00000054h
  loc_004D3688: push 00495B38h
  loc_004D368D: push esi
  loc_004D368E: push eax
  loc_004D368F: call ebx
  loc_004D3691: mov eax, [004E52BCh]
  loc_004D3696: cmp eax, edi
  loc_004D3698: jnz 004D36AFh
  loc_004D369A: push 004E52BCh
  loc_004D369F: push 0048B4B4h
  loc_004D36A4: call [00401100h] ; __vbaNew2
  loc_004D36AA: mov eax, [004E52BCh]
  loc_004D36AF: mov ecx, [eax]
  loc_004D36B1: push eax
  loc_004D36B2: call [ecx+00000308h]
  loc_004D36B8: mov edi, [00401060h] ; __vbaObjSet
  loc_004D36BE: lea edx, var_14
  loc_004D36C1: push eax
  loc_004D36C2: push edx
  loc_004D36C3: call edi
  loc_004D36C5: mov esi, eax
  loc_004D36C7: push 00008000h
  loc_004D36CC: push esi
  loc_004D36CD: mov eax, [esi]
  loc_004D36CF: call [eax+0000006Ch]
  loc_004D36D2: test eax, eax
  loc_004D36D4: fnclex
  loc_004D36D6: jge 004D36E3h
  loc_004D36D8: push 0000006Ch
  loc_004D36DA: push 00495B78h
  loc_004D36DF: push esi
  loc_004D36E0: push eax
  loc_004D36E1: call ebx
  loc_004D36E3: mov ebx, [00401188h] ; __vbaFreeObj
  loc_004D36E9: lea ecx, var_14
  loc_004D36EC: call ebx
  loc_004D36EE: mov eax, [004E52BCh]
  loc_004D36F3: test eax, eax
  loc_004D36F5: jnz 004D370Ch
  loc_004D36F7: push 004E52BCh
  loc_004D36FC: push 0048B4B4h
  loc_004D3701: call [00401100h] ; __vbaNew2
  loc_004D3707: mov eax, [004E52BCh]
  loc_004D370C: mov ecx, [eax]
  loc_004D370E: push eax
  loc_004D370F: call [ecx+00000308h]
  loc_004D3715: lea edx, var_14
  loc_004D3718: push eax
  loc_004D3719: push edx
  loc_004D371A: call edi
  loc_004D371C: mov esi, eax
  loc_004D371E: push 00495B90h ; "?? ???? ????? ??? ????????? ?"
  loc_004D3723: push esi
  loc_004D3724: mov eax, [esi]
  loc_004D3726: call [eax+00000054h]
  loc_004D3729: test eax, eax
  loc_004D372B: fnclex
  loc_004D372D: jge 004D373Eh
  loc_004D372F: push 00000054h
  loc_004D3731: push 00495B78h
  loc_004D3736: push esi
  loc_004D3737: push eax
  loc_004D3738: call [00401048h] ; __vbaHresultCheckObj
  loc_004D373E: lea ecx, var_14
  loc_004D3741: call ebx
  loc_004D3743: mov eax, [004E52BCh]
  loc_004D3748: test eax, eax
  loc_004D374A: jnz 004D375Ch
  loc_004D374C: push 004E52BCh
  loc_004D3751: push 0048B4B4h
  loc_004D3756: call [00401100h] ; __vbaNew2
  loc_004D375C: sub esp, 00000010h
  loc_004D375F: mov ecx, 0000000Ah
  loc_004D3764: mov ebx, esp
  loc_004D3766: mov var_54, ecx
  loc_004D3769: mov eax, 80020004h
  loc_004D376E: sub esp, 00000010h
  loc_004D3771: mov [ebx], ecx
  loc_004D3773: mov ecx, var_50
  loc_004D3776: mov var_4C, eax
  loc_004D3779: mov esi, [004E52BCh]
  loc_004D377F: mov [ebx+00000004h], ecx
  loc_004D3782: mov var_44, 00000002h
  loc_004D3789: mov ecx, esp
  loc_004D378B: mov edx, 00000001h
  loc_004D3790: mov [ebx+00000008h], eax
  loc_004D3793: mov eax, var_48
  loc_004D3796: mov var_3C, edx
  loc_004D3799: mov edi, [esi]
  loc_004D379B: mov [ebx+0000000Ch], eax
  loc_004D379E: mov eax, var_44
  loc_004D37A1: mov [ecx], eax
  loc_004D37A3: mov eax, var_40
  loc_004D37A6: push esi
  loc_004D37A7: mov [ecx+00000004h], eax
  loc_004D37AA: mov [ecx+00000008h], edx
  loc_004D37AD: mov edx, var_38
  loc_004D37B0: mov [ecx+0000000Ch], edx
  loc_004D37B3: call [edi+000002B0h]
  loc_004D37B9: test eax, eax
  loc_004D37BB: fnclex
  loc_004D37BD: jge 004D37D1h
  loc_004D37BF: push 000002B0h
  loc_004D37C4: push 00495B38h
  loc_004D37C9: push esi
  loc_004D37CA: push eax
  loc_004D37CB: call [00401048h] ; __vbaHresultCheckObj
  loc_004D37D1: mov eax, [004E5078h]
  loc_004D37D6: mov esi, arg_8
  loc_004D37D9: cmp eax, 00000001h
  loc_004D37DC: push 00000000h
  loc_004D37DE: push 00495BCCh ; "UpdateBatch"
  loc_004D37E3: mov edx, esi
  loc_004D37E5: lea ecx, var_54
  loc_004D37E8: jnz 004D380Fh
  loc_004D37EA: call [00401014h] ; __vbaVarVargNofree
  loc_004D37F0: push eax
  loc_004D37F1: call [004010A4h] ; __vbaObjVar
  loc_004D37F7: push eax
  loc_004D37F8: call [00401144h] ; __vbaLateMemCall
  loc_004D37FE: mov edi, [00401100h] ; __vbaNew2
  loc_004D3804: mov ebx, [00401048h] ; __vbaHresultCheckObj
  loc_004D380A: add esp, 0000000Ch
  loc_004D380D: jmp 004D3877h
  loc_004D380F: call [00401014h] ; __vbaVarVargNofree
  loc_004D3815: mov ebx, [004010A4h] ; __vbaObjVar
  loc_004D381B: push eax
  loc_004D381C: call ebx
  loc_004D381E: mov edi, [00401144h] ; __vbaLateMemCall
  loc_004D3824: push eax
  loc_004D3825: call edi
  loc_004D3827: add esp, 0000000Ch
  loc_004D382A: mov edx, esi
  loc_004D382C: lea ecx, var_54
  loc_004D382F: push 00000000h
  loc_004D3831: push 00495BE4h ; "Delete"
  loc_004D3836: call [00401014h] ; __vbaVarVargNofree
  loc_004D383C: push eax
  loc_004D383D: call ebx
  loc_004D383F: push eax
  loc_004D3840: call edi
  loc_004D3842: add esp, 0000000Ch
  loc_004D3845: mov edx, esi
  loc_004D3847: lea ecx, var_54
  loc_004D384A: push 00000000h
  loc_004D384C: push 00495BCCh ; "UpdateBatch"
  loc_004D3851: call [00401014h] ; __vbaVarVargNofree
  loc_004D3857: push eax
  loc_004D3858: call ebx
  loc_004D385A: push eax
  loc_004D385B: call edi
  loc_004D385D: mov edi, [00401100h] ; __vbaNew2
  loc_004D3863: mov ebx, [00401048h] ; __vbaHresultCheckObj
  loc_004D3869: add esp, 0000000Ch
  loc_004D386C: jmp 004D3877h
  loc_004D386E: mov esi, arg_8
  loc_004D3871: mov edi, [00401100h] ; __vbaNew2
  loc_004D3877: lea eax, var_44
  loc_004D387A: push 004E5090h
  loc_004D387F: push eax
  loc_004D3880: mov var_3C, 0049549Ch ; "M"
  loc_004D3887: mov var_44, 00008008h
  loc_004D388E: call [0040109Ch] ; __vbaVarTstEq
  loc_004D3894: test ax, ax
  loc_004D3897: jz 004D3AA1h
  loc_004D389D: mov eax, [004E52BCh]
  loc_004D38A2: test eax, eax
  loc_004D38A4: jnz 004D38B2h
  loc_004D38A6: push 004E52BCh
  loc_004D38AB: push 0048B4B4h
  loc_004D38B0: call edi
  loc_004D38B2: mov esi, [004E52BCh]
  loc_004D38B8: push 00495A80h ; "?????"
  loc_004D38BD: push esi
  loc_004D38BE: mov ecx, [esi]
  loc_004D38C0: call [ecx+00000054h]
  loc_004D38C3: test eax, eax
  loc_004D38C5: fnclex
  loc_004D38C7: jge 004D38D4h
  loc_004D38C9: push 00000054h
  loc_004D38CB: push 00495B38h
  loc_004D38D0: push esi
  loc_004D38D1: push eax
  loc_004D38D2: call ebx
  loc_004D38D4: mov eax, [004E52BCh]
  loc_004D38D9: test eax, eax
  loc_004D38DB: jnz 004D38EEh
  loc_004D38DD: push 004E52BCh
  loc_004D38E2: push 0048B4B4h
  loc_004D38E7: call edi
  loc_004D38E9: mov eax, [004E52BCh]
  loc_004D38EE: mov edx, [eax]
  loc_004D38F0: push eax
  loc_004D38F1: call [edx+00000308h]
  loc_004D38F7: push eax
  loc_004D38F8: lea eax, var_14
  loc_004D38FB: push eax
  loc_004D38FC: call [00401060h] ; __vbaObjSet
  loc_004D3902: mov esi, eax
  loc_004D3904: push 00008000h
  loc_004D3909: push esi
  loc_004D390A: mov ecx, [esi]
  loc_004D390C: call [ecx+0000006Ch]
  loc_004D390F: test eax, eax
  loc_004D3911: fnclex
  loc_004D3913: jge 004D3920h
  loc_004D3915: push 0000006Ch
  loc_004D3917: push 00495B78h
  loc_004D391C: push esi
  loc_004D391D: push eax
  loc_004D391E: call ebx
  loc_004D3920: lea ecx, var_14
  loc_004D3923: call [00401188h] ; __vbaFreeObj
  loc_004D3929: mov eax, [004E52BCh]
  loc_004D392E: test eax, eax
  loc_004D3930: jnz 004D3943h
  loc_004D3932: push 004E52BCh
  loc_004D3937: push 0048B4B4h
  loc_004D393C: call edi
  loc_004D393E: mov eax, [004E52BCh]
  loc_004D3943: mov edx, [eax]
  loc_004D3945: push eax
  loc_004D3946: call [edx+00000308h]
  loc_004D394C: push eax
  loc_004D394D: lea eax, var_14
  loc_004D3950: push eax
  loc_004D3951: call [00401060h] ; __vbaObjSet
  loc_004D3957: mov esi, eax
  loc_004D3959: push 00495B90h ; "?? ???? ????? ??? ????????? ?"
  loc_004D395E: push esi
  loc_004D395F: mov ecx, [esi]
  loc_004D3961: call [ecx+00000054h]
  loc_004D3964: test eax, eax
  loc_004D3966: fnclex
  loc_004D3968: jge 004D3975h
  loc_004D396A: push 00000054h
  loc_004D396C: push 00495B78h
  loc_004D3971: push esi
  loc_004D3972: push eax
  loc_004D3973: call ebx
  loc_004D3975: lea ecx, var_14
  loc_004D3978: call [00401188h] ; __vbaFreeObj
  loc_004D397E: mov eax, [004E52BCh]
  loc_004D3983: test eax, eax
  loc_004D3985: jnz 004D3993h
  loc_004D3987: push 004E52BCh
  loc_004D398C: push 0048B4B4h
  loc_004D3991: call edi
  loc_004D3993: sub esp, 00000010h
  loc_004D3996: mov ecx, 0000000Ah
  loc_004D399B: mov ebx, esp
  loc_004D399D: mov var_54, ecx
  loc_004D39A0: mov eax, 80020004h
  loc_004D39A5: sub esp, 00000010h
  loc_004D39A8: mov [ebx], ecx
  loc_004D39AA: mov ecx, var_50
  loc_004D39AD: mov var_4C, eax
  loc_004D39B0: mov esi, [004E52BCh]
  loc_004D39B6: mov [ebx+00000004h], ecx
  loc_004D39B9: mov var_44, 00000002h
  loc_004D39C0: mov ecx, esp
  loc_004D39C2: mov edx, 00000001h
  loc_004D39C7: mov [ebx+00000008h], eax
  loc_004D39CA: mov eax, var_48
  loc_004D39CD: mov var_3C, edx
  loc_004D39D0: mov edi, [esi]
  loc_004D39D2: mov [ebx+0000000Ch], eax
  loc_004D39D5: mov eax, var_44
  loc_004D39D8: mov [ecx], eax
  loc_004D39DA: mov eax, var_40
  loc_004D39DD: push esi
  loc_004D39DE: mov [ecx+00000004h], eax
  loc_004D39E1: mov [ecx+00000008h], edx
  loc_004D39E4: mov edx, var_38
  loc_004D39E7: mov [ecx+0000000Ch], edx
  loc_004D39EA: call [edi+000002B0h]
  loc_004D39F0: test eax, eax
  loc_004D39F2: fnclex
  loc_004D39F4: jge 004D3A08h
  loc_004D39F6: push 000002B0h
  loc_004D39FB: push 00495B38h
  loc_004D3A00: push esi
  loc_004D3A01: push eax
  loc_004D3A02: call [00401048h] ; __vbaHresultCheckObj
  loc_004D3A08: mov eax, [004E5078h]
  loc_004D3A0D: push 00000000h
  loc_004D3A0F: cmp eax, 00000001h
  loc_004D3A12: jnz 004D3A71h
  loc_004D3A14: mov esi, arg_8
  loc_004D3A17: push 00495BCCh ; "UpdateBatch"
  loc_004D3A1C: mov edx, esi
  loc_004D3A1E: lea ecx, var_54
  loc_004D3A21: call [00401014h] ; __vbaVarVargNofree
  loc_004D3A27: mov ebx, [004010A4h] ; __vbaObjVar
  loc_004D3A2D: push eax
  loc_004D3A2E: call ebx
  loc_004D3A30: mov edi, [00401144h] ; __vbaLateMemCall
  loc_004D3A36: push eax
  loc_004D3A37: call edi
  loc_004D3A39: add esp, 0000000Ch
  loc_004D3A3C: mov edx, esi
  loc_004D3A3E: lea ecx, var_54
  loc_004D3A41: push 00000000h
  loc_004D3A43: push 00495BF4h ; "MoveNext"
  loc_004D3A48: call [00401014h] ; __vbaVarVargNofree
  loc_004D3A4E: push eax
  loc_004D3A4F: call ebx
  loc_004D3A51: push eax
  loc_004D3A52: call edi
  loc_004D3A54: add esp, 0000000Ch
  loc_004D3A57: mov edx, esi
  loc_004D3A59: lea ecx, var_54
  loc_004D3A5C: push 00000000h
  loc_004D3A5E: push 00495C08h ; "MovePrevious"
  loc_004D3A63: call [00401014h] ; __vbaVarVargNofree
  loc_004D3A69: push eax
  loc_004D3A6A: call ebx
  loc_004D3A6C: push eax
  loc_004D3A6D: call edi
  loc_004D3A6F: jmp 004D3A92h
  loc_004D3A71: mov esi, arg_8
  loc_004D3A74: push 00495C24h ; "CancelUpdate"
  loc_004D3A79: mov edx, esi
  loc_004D3A7B: lea ecx, var_54
  loc_004D3A7E: call [00401014h] ; __vbaVarVargNofree
  loc_004D3A84: push eax
  loc_004D3A85: call [004010A4h] ; __vbaObjVar
  loc_004D3A8B: push eax
  loc_004D3A8C: call [00401144h] ; __vbaLateMemCall
  loc_004D3A92: mov edi, [00401100h] ; __vbaNew2
  loc_004D3A98: mov ebx, [00401048h] ; __vbaHresultCheckObj
  loc_004D3A9E: add esp, 0000000Ch
  loc_004D3AA1: lea eax, var_44
  loc_004D3AA4: push 004E5090h
  loc_004D3AA9: push eax
  loc_004D3AAA: mov var_3C, 00494F68h ; "S"
  loc_004D3AB1: mov var_44, 00008008h
  loc_004D3AB8: call [0040109Ch] ; __vbaVarTstEq
  loc_004D3ABE: test ax, ax
  loc_004D3AC1: jz 004D3CE4h
  loc_004D3AC7: push 00000000h
  loc_004D3AC9: push 00495C40h ; "RecordCount"
  loc_004D3ACE: lea ecx, var_24
  loc_004D3AD1: push esi
  loc_004D3AD2: push ecx
  loc_004D3AD3: mov var_4C, 00000000h
  loc_004D3ADA: mov var_54, 00008002h
  loc_004D3AE1: call [00401154h] ; __vbaVarLateMemCallLd
  loc_004D3AE7: add esp, 00000010h
  loc_004D3AEA: lea edx, var_54
  loc_004D3AED: push eax
  loc_004D3AEE: push edx
  loc_004D3AEF: call [00401130h] ; __vbaVarTstNe
  loc_004D3AF5: lea ecx, var_24
  loc_004D3AF8: mov si, ax
  loc_004D3AFB: call [00401018h] ; __vbaFreeVar
  loc_004D3B01: test si, si
  loc_004D3B04: jz 004D3CE4h
  loc_004D3B0A: mov eax, [004E52BCh]
  loc_004D3B0F: test eax, eax
  loc_004D3B11: jnz 004D3B1Fh
  loc_004D3B13: push 004E52BCh
  loc_004D3B18: push 0048B4B4h
  loc_004D3B1D: call edi
  loc_004D3B1F: mov esi, [004E52BCh]
  loc_004D3B25: push 00495A80h ; "?????"
  loc_004D3B2A: push esi
  loc_004D3B2B: mov eax, [esi]
  loc_004D3B2D: call [eax+00000054h]
  loc_004D3B30: test eax, eax
  loc_004D3B32: fnclex
  loc_004D3B34: jge 004D3B41h
  loc_004D3B36: push 00000054h
  loc_004D3B38: push 00495B38h
  loc_004D3B3D: push esi
  loc_004D3B3E: push eax
  loc_004D3B3F: call ebx
  loc_004D3B41: mov eax, [004E52BCh]
  loc_004D3B46: test eax, eax
  loc_004D3B48: jnz 004D3B5Bh
  loc_004D3B4A: push 004E52BCh
  loc_004D3B4F: push 0048B4B4h
  loc_004D3B54: call edi
  loc_004D3B56: mov eax, [004E52BCh]
  loc_004D3B5B: mov ecx, [eax]
  loc_004D3B5D: push eax
  loc_004D3B5E: call [ecx+00000308h]
  loc_004D3B64: lea edx, var_14
  loc_004D3B67: push eax
  loc_004D3B68: push edx
  loc_004D3B69: call [00401060h] ; __vbaObjSet
  loc_004D3B6F: mov esi, eax
  loc_004D3B71: push 000000C0h
  loc_004D3B76: push esi
  loc_004D3B77: mov eax, [esi]
  loc_004D3B79: call [eax+0000006Ch]
  loc_004D3B7C: test eax, eax
  loc_004D3B7E: fnclex
  loc_004D3B80: jge 004D3B8Dh
  loc_004D3B82: push 0000006Ch
  loc_004D3B84: push 00495B78h
  loc_004D3B89: push esi
  loc_004D3B8A: push eax
  loc_004D3B8B: call ebx
  loc_004D3B8D: lea ecx, var_14
  loc_004D3B90: call [00401188h] ; __vbaFreeObj
  loc_004D3B96: mov eax, [004E52BCh]
  loc_004D3B9B: test eax, eax
  loc_004D3B9D: jnz 004D3BB0h
  loc_004D3B9F: push 004E52BCh
  loc_004D3BA4: push 0048B4B4h
  loc_004D3BA9: call edi
  loc_004D3BAB: mov eax, [004E52BCh]
  loc_004D3BB0: mov ecx, [eax]
  loc_004D3BB2: push eax
  loc_004D3BB3: call [ecx+00000308h]
  loc_004D3BB9: lea edx, var_14
  loc_004D3BBC: push eax
  loc_004D3BBD: push edx
  loc_004D3BBE: call [00401060h] ; __vbaObjSet
  loc_004D3BC4: mov esi, eax
  loc_004D3BC6: push 00495C5Ch ; "?? ??? ????? ??? ??? ????????? ?"
  loc_004D3BCB: push esi
  loc_004D3BCC: mov eax, [esi]
  loc_004D3BCE: call [eax+00000054h]
  loc_004D3BD1: test eax, eax
  loc_004D3BD3: fnclex
  loc_004D3BD5: jge 004D3BE2h
  loc_004D3BD7: push 00000054h
  loc_004D3BD9: push 00495B78h
  loc_004D3BDE: push esi
  loc_004D3BDF: push eax
  loc_004D3BE0: call ebx
  loc_004D3BE2: lea ecx, var_14
  loc_004D3BE5: call [00401188h] ; __vbaFreeObj
  loc_004D3BEB: mov eax, [004E52BCh]
  loc_004D3BF0: test eax, eax
  loc_004D3BF2: jnz 004D3C00h
  loc_004D3BF4: push 004E52BCh
  loc_004D3BF9: push 0048B4B4h
  loc_004D3BFE: call edi
  loc_004D3C00: sub esp, 00000010h
  loc_004D3C03: mov ecx, 0000000Ah
  loc_004D3C08: mov ebx, esp
  loc_004D3C0A: mov var_54, ecx
  loc_004D3C0D: mov eax, 80020004h
  loc_004D3C12: sub esp, 00000010h
  loc_004D3C15: mov [ebx], ecx
  loc_004D3C17: mov ecx, var_50
  loc_004D3C1A: mov var_4C, eax
  loc_004D3C1D: mov esi, [004E52BCh]
  loc_004D3C23: mov [ebx+00000004h], ecx
  loc_004D3C26: mov var_44, 00000002h
  loc_004D3C2D: mov ecx, esp
  loc_004D3C2F: mov edx, 00000001h
  loc_004D3C34: mov [ebx+00000008h], eax
  loc_004D3C37: mov eax, var_48
  loc_004D3C3A: mov var_3C, edx
  loc_004D3C3D: mov edi, [esi]
  loc_004D3C3F: mov [ebx+0000000Ch], eax
  loc_004D3C42: mov eax, var_44
  loc_004D3C45: mov [ecx], eax
  loc_004D3C47: mov eax, var_40
  loc_004D3C4A: push esi
  loc_004D3C4B: mov [ecx+00000004h], eax
  loc_004D3C4E: mov [ecx+00000008h], edx
  loc_004D3C51: mov edx, var_38
  loc_004D3C54: mov [ecx+0000000Ch], edx
  loc_004D3C57: call [edi+000002B0h]
  loc_004D3C5D: test eax, eax
  loc_004D3C5F: fnclex
  loc_004D3C61: jge 004D3C75h
  loc_004D3C63: push 000002B0h
  loc_004D3C68: push 00495B38h
  loc_004D3C6D: push esi
  loc_004D3C6E: push eax
  loc_004D3C6F: call [00401048h] ; __vbaHresultCheckObj
  loc_004D3C75: cmp [004E5078h], 00000001h
  loc_004D3C7C: jnz 004D3CDEh
  loc_004D3C7E: mov esi, arg_8
  loc_004D3C81: push 00000000h
  loc_004D3C83: push 00495BCCh ; "UpdateBatch"
  loc_004D3C88: mov edx, esi
  loc_004D3C8A: lea ecx, var_54
  loc_004D3C8D: call [00401014h] ; __vbaVarVargNofree
  loc_004D3C93: mov ebx, [004010A4h] ; __vbaObjVar
  loc_004D3C99: push eax
  loc_004D3C9A: call ebx
  loc_004D3C9C: mov edi, [00401144h] ; __vbaLateMemCall
  loc_004D3CA2: push eax
  loc_004D3CA3: call edi
  loc_004D3CA5: add esp, 0000000Ch
  loc_004D3CA8: mov edx, esi
  loc_004D3CAA: lea ecx, var_54
  loc_004D3CAD: push 00000000h
  loc_004D3CAF: push 00495BE4h ; "Delete"
  loc_004D3CB4: call [00401014h] ; __vbaVarVargNofree
  loc_004D3CBA: push eax
  loc_004D3CBB: call ebx
  loc_004D3CBD: push eax
  loc_004D3CBE: call edi
  loc_004D3CC0: add esp, 0000000Ch
  loc_004D3CC3: mov edx, esi
  loc_004D3CC5: lea ecx, var_54
  loc_004D3CC8: push 00000000h
  loc_004D3CCA: push 00495BCCh ; "UpdateBatch"
  loc_004D3CCF: call [00401014h] ; __vbaVarVargNofree
  loc_004D3CD5: push eax
  loc_004D3CD6: call ebx
  loc_004D3CD8: push eax
  loc_004D3CD9: call edi
  loc_004D3CDB: add esp, 0000000Ch
  loc_004D3CDE: mov ebx, [00401048h] ; __vbaHresultCheckObj
  loc_004D3CE4: mov eax, [004E50A4h]
  loc_004D3CE9: push eax
  loc_004D3CEA: mov ecx, [eax]
  loc_004D3CEC: call [ecx+00000048h]
  loc_004D3CEF: test eax, eax
  loc_004D3CF1: fnclex
  loc_004D3CF3: jge 004D3D06h
  loc_004D3CF5: mov edx, [004E50A4h]
  loc_004D3CFB: push 00000048h
  loc_004D3CFD: push 00494E44h
  loc_004D3D02: push edx
  loc_004D3D03: push eax
  loc_004D3D04: call ebx
  loc_004D3D06: push 004D3D2Bh
  loc_004D3D0B: jmp 004D3D2Ah
  loc_004D3D0D: lea ecx, var_14
  loc_004D3D10: call [00401188h] ; __vbaFreeObj
  loc_004D3D16: lea eax, var_34
  loc_004D3D19: lea ecx, var_24
  loc_004D3D1C: push eax
  loc_004D3D1D: push ecx
  loc_004D3D1E: push 00000002h
  loc_004D3D20: call [00401028h] ; __vbaFreeVarList
  loc_004D3D26: add esp, 0000000Ch
  loc_004D3D29: ret
  loc_004D3D2A: ret
  loc_004D3D2B: mov ecx, var_10
  loc_004D3D2E: pop edi
  loc_004D3D2F: pop esi
  loc_004D3D30: mov fs:[00000000h], ecx
  loc_004D3D37: pop ebx
  loc_004D3D38: mov esp, ebp
  loc_004D3D3A: pop ebp
  loc_004D3D3B: retn 0004h
End Sub
