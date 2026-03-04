VERSION 5.00
Object = "{0D452EE1-E08F-101A-852E-02608C4D0BB4}#2.0#0"; "C:\WINDOWS\SysWow64\FM20.DLL"
Object = "{F32D2BB7-65DF-400D-AA23-E1A03E7510C4}#2.0#0"; "C:\WINDOWS\SysWow64\Di6InputBox.ocx"
Object = "{F0D2F211-CCB0-11D0-A316-00AA00688B10}#1.0#0"; "C:\WINDOWS\SysWow64\MSDATLST.OCX"
Object = "{00025600-0000-0000-C000-000000000046}#5.2#0"; "C:\WINDOWS\SysWow64\Crystl32.OCX"

Begin VB.Form FFiche
    ScaleMode = 1
    AutoRedraw = 0              'False
    FontTransparent = -1              'True
    FillStyle = 2
    BorderStyle = 1
    LinkTopic = "Form36"
    MaxButton = 0              'False
    MinButton = 0              'False
    ClientLeft   = 45
    ClientTop    = 330
    ClientWidth  = 12435
    ClientHeight = 10335
    StartupPosition = 2
    Begin VB.TextBox Text77
        Left   = 3600
        Top    = 9840
        Width  = 855
        Height = 285
        Visible = 0              'False
        TabIndex = 61
        DataField = "NomPresident"
    End
    Begin VB.Frame Frame3
        Caption = "???C?"
        ForeColor = 32768
        Left   = 240
        Top    = 2160
        Width  = 4695
        Height = 1380
        TabIndex = 56
        RightToLeft = -1              'True
        Begin VB.Frame Frame25
            Caption = "???C? C??E?C??E"
            ForeColor = 32768
            Left   = 2520
            Top    = 240
            Width  = 1935
            Height = 900
            TabIndex = 59
            RightToLeft = -1              'True
            Begin MSForms.CheckBox CheckBox2
                Left   = 360
                Top    = 240
                Width  = 1455
                Height = 495
                TabIndex = 60
                OleObjectBlob = FFiche.frx:0000
                DataField = "Retour"
            End
        End
        Begin VB.Frame Frame23
            Caption = "EC??I C????C?"
            ForeColor = 12582912
            Left   = 360
            Top    = 240
            Width  = 1935
            Height = 900
            TabIndex = 57
            RightToLeft = -1              'True
            Begin Di6InputBox.InputBox Text18
                Left   = 120
                Top    = 360
                Width  = 1695
                Height = 420
                TabIndex = 58
                BeginProperty DataFormat 
                    Type              = 0
                    Format            = "#0.00"
                    HaveTrueFalseNull = 0              'False
                    FirstDayOfWeek = 0
                    FirstWeekOfYear = 0
                    LCID            = 7169
                    SubFormatType   = 0
                EndProperty
                OleObjectBlob = FFiche.frx:0000
                DataField = "DateRetour"
            End
        End
    End
    Begin VB.Frame Frame2
        Caption = "E????"
        ForeColor = 32768
        Left   = 240
        Top    = 360
        Width  = 4695
        Height = 1380
        TabIndex = 51
        RightToLeft = -1              'True
        Begin VB.Frame Frame24
            Caption = "EC??I CE????"
            ForeColor = 12582912
            Left   = 360
            Top    = 240
            Width  = 1935
            Height = 900
            TabIndex = 54
            RightToLeft = -1              'True
            Begin Di6InputBox.InputBox Text17
                Left   = 120
                Top    = 360
                Width  = 1695
                Height = 420
                TabIndex = 55
                BeginProperty DataFormat 
                    Type              = 0
                    Format            = "#0.00"
                    HaveTrueFalseNull = 0              'False
                    FirstDayOfWeek = 0
                    FirstWeekOfYear = 0
                    LCID            = 7169
                    SubFormatType   = 0
                EndProperty
                OleObjectBlob = FFiche.frx:0000
                DataField = "DateSignature"
            End
        End
        Begin VB.Frame Frame21
            Caption = "E???? C??E?C??E"
            ForeColor = 192
            Left   = 2520
            Top    = 240
            Width  = 1935
            Height = 900
            TabIndex = 52
            RightToLeft = -1              'True
            Begin MSForms.CheckBox CheckBox1
                Left   = 240
                Top    = 240
                Width  = 1455
                Height = 495
                TabIndex = 53
                OleObjectBlob = FFiche.frx:0000
                DataField = "Signature"
            End
        End
    End
    Begin VB.Frame Frame4
        Caption = "E???? EC??EC?E"
        ForeColor = 32768
        Left   = 240
        Top    = 3840
        Width  = 4695
        Height = 3180
        TabIndex = 40
        RightToLeft = -1              'True
        Begin VB.Frame Frame18
            Caption = "E? C?E???? EC??EC?E"
            ForeColor = 192
            Left   = 1320
            Top    = 360
            Width  = 2295
            Height = 780
            TabIndex = 47
            RightToLeft = -1              'True
            Begin MSForms.CheckBox CheckBox3
                Left   = 360
                Top    = 240
                Width  = 1695
                Height = 495
                TabIndex = 48
                OleObjectBlob = FFiche.frx:0000
                DataField = "ValidEnr"
            End
        End
        Begin VB.Frame Frame16
            Caption = "????? C?E????"
            ForeColor = 8388736
            Left   = 1320
            Top    = 2160
            Width  = 1935
            Height = 900
            TabIndex = 45
            RightToLeft = -1              'True
            Begin Di6InputBox.InputBox Text13
                Left   = 120
                Top    = 240
                Width  = 1695
                Height = 540
                TabIndex = 46
                BeginProperty DataFormat 
                    Type              = 0
                    Format            = "#0.00"
                    HaveTrueFalseNull = 0              'False
                    FirstDayOfWeek = 0
                    FirstWeekOfYear = 0
                    LCID            = 7169
                    SubFormatType   = 0
                EndProperty
                OleObjectBlob = FFiche.frx:0000
                DataField = "MontantEnr"
            End
        End
        Begin VB.Frame Frame15
            Caption = "?II C????"
            ForeColor = 192
            Left   = 2160
            Top    = 1200
            Width  = 2295
            Height = 900
            TabIndex = 43
            RightToLeft = -1              'True
            Begin VB.TextBox Text11
                Left   = 120
                Top    = 315
                Width  = 2055
                Height = 480
                TabIndex = 44
                Alignment = 1
                MaxLength = 50
                DataField = "NumeroEnr"
                BeginProperty Font
                    Name          = "MS Sans Serif"
                    Size          = 13,5
                    Charset       = 178
                    Weight        = 700
                    Underline     = 0              'False
                    Italic        = 0              'False
                    Strikethrough = 0              'False
                EndProperty
                RightToLeft = -1              'True
            End
        End
        Begin VB.Frame Frame14
            Caption = "EC??I C????"
            ForeColor = 12582912
            Left   = 120
            Top    = 1200
            Width  = 1935
            Height = 900
            TabIndex = 41
            RightToLeft = -1              'True
            Begin Di6InputBox.InputBox Text12
                Left   = 120
                Top    = 360
                Width  = 1695
                Height = 420
                TabIndex = 42
                BeginProperty DataFormat 
                    Type              = 0
                    Format            = "#0.00"
                    HaveTrueFalseNull = 0              'False
                    FirstDayOfWeek = 0
                    FirstWeekOfYear = 0
                    LCID            = 7169
                    SubFormatType   = 0
                EndProperty
                OleObjectBlob = FFiche.frx:0000
                DataField = "DateEnr"
            End
        End
    End
    Begin VB.TextBox Text99
        Left   = 3840
        Top    = 7200
        Width  = 855
        Height = 285
        Visible = 0              'False
        TabIndex = 39
        DataField = "MontantLit"
    End
    Begin VB.Frame Frame38
        Left   = 2400
        Top    = 7560
        Width  = 1815
        Height = 1005
        TabIndex = 35
        RightToLeft = -1              'True
        Begin VB.CommandButton Command2
            Left   = 120
            Top    = 240
            Width  = 1575
            Height = 615
            TabIndex = 36
            BeginProperty Font
                Name          = "Tahoma"
                Size          = 14,25
                Charset       = 178
                Weight        = 400
                Underline     = 0              'False
                Italic        = 0              'False
                Strikethrough = 0              'False
            EndProperty
            RightToLeft = -1              'True
            Picture = FFiche.frx:0000
            ToolTipText = "?EC?E C????CE"
            Style = 1
        End
    End
    Begin VB.Frame Frame17
        ForeColor = 8388736
        Left   = 480
        Top    = 7560
        Width  = 1815
        Height = 1020
        TabIndex = 33
        RightToLeft = -1              'True
        Begin VB.CommandButton Command1
            Left   = 120
            Top    = 240
            Width  = 1575
            Height = 615
            TabIndex = 34
            Picture = FFiche.frx:1996
            Style = 1
        End
    End
    Begin VB.Frame Frame43
        Left   = 480
        Top    = 8640
        Width  = 3705
        Height = 975
        TabIndex = 28
        RightToLeft = -1              'True
        Begin VB.CommandButton Command10
            Left   = 1080
            Top    = 285
            Width  = 690
            Height = 450
            TabIndex = 32
            Picture = FFiche.frx:2274
            Style = 1
        End
        Begin VB.CommandButton Command9
            Left   = 1920
            Top    = 285
            Width  = 690
            Height = 450
            TabIndex = 31
            Picture = FFiche.frx:2972
            Style = 1
        End
        Begin VB.CommandButton Command11
            Left   = 120
            Top    = 240
            Width  = 855
            Height = 570
            TabIndex = 30
            Picture = FFiche.frx:3070
            Style = 1
        End
        Begin VB.CommandButton Command8
            Left   = 2760
            Top    = 240
            Width  = 855
            Height = 570
            TabIndex = 29
            Picture = FFiche.frx:394E
            Style = 1
        End
    End
    Begin VB.TextBox Text88
        Left   = 5520
        Top    = 6600
        Width  = 855
        Height = 285
        Visible = 0              'False
        Text = "Text8"
        TabIndex = 15
        DataField = "NumOrd"
    End
    Begin VB.Frame Frame1
        Caption = " "
        ForeColor = 8388736
        Left   = 5160
        Top    = 120
        Width  = 7095
        Height = 10095
        TabIndex = 12
        RightToLeft = -1              'True
        Begin VB.Frame Frame20
            Caption = "?II C???C?"
            ForeColor = 32768
            Left   = 2760
            Top    = 5520
            Width  = 1815
            Height = 900
            TabIndex = 63
            RightToLeft = -1              'True
            Begin Di6InputBox.InputBox Text19
                Left   = 120
                Top    = 240
                Width  = 1575
                Height = 540
                TabIndex = 64
                BeginProperty DataFormat 
                    Type              = 0
                    Format            = "#0.00"
                    HaveTrueFalseNull = 0              'False
                    FirstDayOfWeek = 0
                    FirstWeekOfYear = 0
                    LCID            = 7169
                    SubFormatType   = 0
                EndProperty
                OleObjectBlob = FFiche.frx:422C
                DataField = "NbrJour"
            End
        End
        Begin VB.Frame Frame33
            Caption = "C????C?"
            ForeColor = 12582912
            Left   = 240
            Top    = 240
            Width  = 6615
            Height = 900
            TabIndex = 49
            RightToLeft = -1              'True
            Begin MSDataListLib.DataCombo DataCombo3
                Left   = 120
                Top    = 240
                Width  = 6375
                Height = 480
                TabIndex = 50
                OleObjectBlob = FFiche.frx:422C
                DataField = "CodeAdr"
            End
        End
        Begin VB.Frame Frame19
            Caption = "??? C??CE?"
            ForeColor = 16711680
            Left   = 240
            Top    = 2880
            Width  = 3375
            Height = 780
            TabIndex = 37
            RightToLeft = -1              'True
            Begin VB.TextBox Text15
                Left   = 120
                Top    = 240
                Width  = 3135
                Height = 435
                TabIndex = 38
                Alignment = 1
                MaxLength = 10
                DataField = "Telephone"
                BeginProperty Font
                    Name          = "MS Sans Serif"
                    Size          = 13,5
                    Charset       = 178
                    Weight        = 700
                    Underline     = 0              'False
                    Italic        = 0              'False
                    Strikethrough = 0              'False
                EndProperty
                RightToLeft = -1              'True
            End
        End
        Begin VB.Frame Frame8
            Caption = "C??????"
            ForeColor = 12583104
            Left   = 2160
            Top    = 7920
            Width  = 2535
            Height = 1020
            TabIndex = 27
            RightToLeft = -1              'True
            Begin Di6InputBox.InputBox Text10
                Left   = 120
                Top    = 240
                Width  = 2295
                Height = 615
                TabIndex = 62
                OleObjectBlob = FFiche.frx:422C
                DataField = "MontantAnn"
            End
        End
        Begin VB.Frame Frame12
            Caption = "C????E EC??E?"
            ForeColor = 32768
            Left   = 4920
            Top    = 7920
            Width  = 1815
            Height = 1020
            TabIndex = 26
            RightToLeft = -1              'True
            Begin Di6InputBox.InputBox Text9
                Left   = 120
                Top    = 240
                Width  = 1575
                Height = 585
                TabIndex = 10
                BeginProperty DataFormat 
                    Type              = 0
                    Format            = "#0.00"
                    HaveTrueFalseNull = 0              'False
                    FirstDayOfWeek = 0
                    FirstWeekOfYear = 0
                    LCID            = 7169
                    SubFormatType   = 0
                EndProperty
                OleObjectBlob = FFiche.frx:422C
                DataField = "Quantite"
            End
        End
        Begin VB.Frame Frame13
            Caption = "?II C????"
            ForeColor = 192
            Left   = 4200
            Top    = 1200
            Width  = 2655
            Height = 780
            TabIndex = 24
            RightToLeft = -1              'True
            Begin VB.TextBox Text14
                Left   = 120
                Top    = 240
                Width  = 2415
                Height = 435
                TabIndex = 25
                Alignment = 1
                MaxLength = 50
                DataField = "Numero"
                Locked = -1              'True
                BeginProperty Font
                    Name          = "MS Sans Serif"
                    Size          = 13,5
                    Charset       = 178
                    Weight        = 700
                    Underline     = 0              'False
                    Italic        = 0              'False
                    Strikethrough = 0              'False
                EndProperty
                RightToLeft = -1              'True
            End
        End
        Begin VB.Frame Frame7
            Caption = "C???EE?C?"
            ForeColor = 128
            Left   = 2400
            Top    = 6600
            Width  = 4455
            Height = 1260
            TabIndex = 21
            RightToLeft = -1              'True
            Begin VB.Frame Frame11
                Caption = "C??E?U"
                ForeColor = 8388736
                Left   = 120
                Top    = 240
                Width  = 2175
                Height = 900
                TabIndex = 23
                RightToLeft = -1              'True
                Begin Di6InputBox.InputBox Text7
                    Left   = 120
                    Top    = 240
                    Width  = 1935
                    Height = 540
                    TabIndex = 8
                    BeginProperty DataFormat 
                        Type              = 0
                        Format            = "#0.00"
                        HaveTrueFalseNull = 0              'False
                        FirstDayOfWeek = 0
                        FirstWeekOfYear = 0
                        LCID            = 7169
                        SubFormatType   = 0
                    EndProperty
                    OleObjectBlob = FFiche.frx:422C
                    DataField = "MontantExc"
                End
            End
            Begin VB.Frame Frame10
                Caption = "C???E"
                ForeColor = 32768
                Left   = 2520
                Top    = 240
                Width  = 1815
                Height = 900
                TabIndex = 22
                RightToLeft = -1              'True
                Begin Di6InputBox.InputBox Text6
                    Left   = 120
                    Top    = 240
                    Width  = 1575
                    Height = 540
                    TabIndex = 7
                    BeginProperty DataFormat 
                        Type              = 0
                        Format            = "#0.00"
                        HaveTrueFalseNull = 0              'False
                        FirstDayOfWeek = 0
                        FirstWeekOfYear = 0
                        LCID            = 7169
                        SubFormatType   = 0
                    EndProperty
                    OleObjectBlob = FFiche.frx:422C
                    DataField = "AnneeExc"
                End
            End
        End
        Begin VB.Frame Frame5
            Caption = "EC??I EIC?E C???I"
            ForeColor = 12582912
            Left   = 4920
            Top    = 5520
            Width  = 1935
            Height = 900
            TabIndex = 20
            RightToLeft = -1              'True
            Begin Di6InputBox.InputBox Text5
                Left   = 120
                Top    = 360
                Width  = 1695
                Height = 420
                TabIndex = 6
                BeginProperty DataFormat 
                    Type              = 0
                    Format            = "#0.00"
                    HaveTrueFalseNull = 0              'False
                    FirstDayOfWeek = 0
                    FirstWeekOfYear = 0
                    LCID            = 7169
                    SubFormatType   = 0
                EndProperty
                OleObjectBlob = FFiche.frx:422C
                DataField = "DateD"
            End
        End
        Begin VB.Frame Frame6
            Caption = "C????? C??EC??"
            ForeColor = 8421376
            Left   = 120
            Top    = 4680
            Width  = 4215
            Height = 780
            TabIndex = 19
            RightToLeft = -1              'True
            Begin VB.TextBox Text4
                Left   = 120
                Top    = 240
                Width  = 3975
                Height = 435
                TabIndex = 5
                Alignment = 1
                MaxLength = 50
                DataField = "MatriculeFis"
                BeginProperty Font
                    Name          = "MS Sans Serif"
                    Size          = 13,5
                    Charset       = 178
                    Weight        = 700
                    Underline     = 0              'False
                    Italic        = 0              'False
                    Strikethrough = 0              'False
                EndProperty
                RightToLeft = -1              'True
            End
        End
        Begin VB.Frame Frame35
            Caption = "E?C?E E???? ????E"
            ForeColor = 192
            Left   = 3720
            Top    = 2880
            Width  = 3135
            Height = 780
            TabIndex = 18
            RightToLeft = -1              'True
            Begin VB.TextBox Text2
                Left   = 120
                Top    = 240
                Width  = 2895
                Height = 435
                TabIndex = 2
                Alignment = 1
                MaxLength = 10
                DataField = "CIN"
                BeginProperty Font
                    Name          = "MS Sans Serif"
                    Size          = 13,5
                    Charset       = 178
                    Weight        = 700
                    Underline     = 0              'False
                    Italic        = 0              'False
                    Strikethrough = 0              'False
                EndProperty
                RightToLeft = -1              'True
            End
        End
        Begin VB.Frame Frame27
            Caption = "C???? C?E?C??"
            ForeColor = 32768
            Left   = 4440
            Top    = 4680
            Width  = 2415
            Height = 780
            TabIndex = 17
            RightToLeft = -1              'True
            Begin VB.TextBox Text3
                Left   = 120
                Top    = 240
                Width  = 2175
                Height = 435
                TabIndex = 4
                Alignment = 1
                MaxLength = 15
                DataField = "NomCom"
                BeginProperty Font
                    Name          = "MS Sans Serif"
                    Size          = 13,5
                    Charset       = 178
                    Weight        = 700
                    Underline     = 0              'False
                    Italic        = 0              'False
                    Strikethrough = 0              'False
                EndProperty
                RightToLeft = -1              'True
            End
        End
        Begin VB.Frame Frame42
            Caption = "??? C??OC?"
            ForeColor = 12582912
            Left   = 240
            Top    = 3720
            Width  = 6615
            Height = 900
            TabIndex = 16
            RightToLeft = -1              'True
            Begin MSDataListLib.DataCombo DataCombo1
                Left   = 120
                Top    = 240
                Width  = 6375
                Height = 480
                TabIndex = 3
                OleObjectBlob = FFiche.frx:422C
                DataField = "CodeAct"
            End
        End
        Begin VB.Frame Frame34
            Caption = "??C?UCE"
            ForeColor = 128
            Left   = 240
            Top    = 9120
            Width  = 6495
            Height = 780
            TabIndex = 14
            RightToLeft = -1              'True
            Begin VB.TextBox Text8
                Left   = 120
                Top    = 240
                Width  = 6255
                Height = 435
                TabIndex = 9
                Alignment = 1
                MaxLength = 50
                DataField = "observation"
                BeginProperty Font
                    Name          = "MS Sans Serif"
                    Size          = 13,5
                    Charset       = 178
                    Weight        = 400
                    Underline     = 0              'False
                    Italic        = 0              'False
                    Strikethrough = 0              'False
                EndProperty
                RightToLeft = -1              'True
            End
        End
        Begin VB.Frame Frame9
            Caption = "C???? ?C???E"
            ForeColor = 12582912
            Left   = 240
            Top    = 2040
            Width  = 6615
            Height = 780
            TabIndex = 13
            RightToLeft = -1              'True
            Begin VB.TextBox Text1
                Left   = 120
                Top    = 240
                Width  = 6375
                Height = 435
                TabIndex = 1
                Alignment = 1
                MaxLength = 50
                DataField = "nom"
                BeginProperty Font
                    Name          = "MS Sans Serif"
                    Size          = 13,5
                    Charset       = 178
                    Weight        = 700
                    Underline     = 0              'False
                    Italic        = 0              'False
                    Strikethrough = 0              'False
                EndProperty
                RightToLeft = -1              'True
            End
        End
    End
    Begin VB.CommandButton Command5
        Caption = "???"
        Left   = 11760
        Top    = 2280
        Width  = 735
        Height = 855
        Visible = 0              'False
        TabIndex = 11
        Picture = FFiche.frx:422C
        Style = 1
    End
    Begin VB.CommandButton Command20
        Caption = "??C?E"
        Left   = 11640
        Top    = 3720
        Width  = 735
        Height = 855
        Visible = 0              'False
        TabIndex = 0
        Picture = FFiche.frx:4B0A
        Style = 1
    End
    Begin Crystal.CrystalReport CRT1
        OleObjectBlob = FFiche.frx:53E8
        Left = 0
        Top = 0
    End
End
