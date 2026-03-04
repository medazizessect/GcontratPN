VERSION 5.00
Object = "{F32D2BB7-65DF-400D-AA23-E1A03E7510C4}#2.0#0"; "C:\WINDOWS\SysWow64\Di6InputBox.ocx"

Begin VB.Form FCategorie
    Caption = "C????C?"
    ScaleMode = 1
    AutoRedraw = 0              'False
    FontTransparent = -1              'True
    BorderStyle = 1
    LinkTopic = "Form37"
    MaxButton = 0              'False
    MinButton = 0              'False
    ClientLeft   = 45
    ClientTop    = 330
    ClientWidth  = 4800
    ClientHeight = 4995
    RightToLeft = -1              'True
    StartupPosition = 2
    Begin VB.TextBox Text2
        Left   = 2160
        Top    = 3240
        Width  = 735
        Height = 285
        Visible = 0              'False
        TabIndex = 16
        Alignment = 1
        DataSource = "Adodc1"
        DataField = "CodeCat"
        RightToLeft = -1              'True
    End
    Begin VB.Frame Frame9
        Caption = "??C? ?E? C???C???"
        ForeColor = 12583104
        Left   = 240
        Top    = 2280
        Width  = 4335
        Height = 780
        TabIndex = 14
        RightToLeft = -1              'True
        Begin VB.TextBox Text8
            Left   = 120
            Top    = 240
            Width  = 4095
            Height = 405
            TabIndex = 15
            Alignment = 1
            MaxLength = 50
            DataField = "Decre"
            BeginProperty Font
                Name          = "MS Sans Serif"
                Size          = 12
                Charset       = 178
                Weight        = 400
                Underline     = 0              'False
                Italic        = 0              'False
                Strikethrough = 0              'False
            EndProperty
            RightToLeft = -1              'True
        End
    End
    Begin VB.Frame Frame7
        Caption = "??C?E C?E?C??"
        ForeColor = 192
        Left   = 240
        Top    = 1080
        Width  = 1455
        Height = 1185
        TabIndex = 13
        RightToLeft = -1              'True
        Begin VB.Frame Frame5
            Caption = "????"
            Left   = 120
            Top    = 240
            Width  = 1215
            Height = 825
            TabIndex = 19
            RightToLeft = -1              'True
            Begin Di6InputBox.InputBox Text7
                Left   = 120
                Top    = 240
                Width  = 975
                Height = 495
                TabIndex = 20
                OleObjectBlob = FCategorie.frx:0000
                DataField = "MontMetCloP"
            End
        End
    End
    Begin VB.Frame Frame8
        Caption = "????? C??I?E"
        Left   = 2760
        Top    = 3600
        Width  = 1815
        Height = 825
        TabIndex = 10
        RightToLeft = -1              'True
        Begin Di6InputBox.InputBox Text3
            Left   = 120
            Top    = 240
            Width  = 1575
            Height = 495
            TabIndex = 11
            OleObjectBlob = FCategorie.frx:0000
            DataField = "MontAut"
        End
    End
    Begin VB.CommandButton Command2
        Left   = 600
        Top    = 4080
        Width  = 1455
        Height = 615
        TabIndex = 8
        BeginProperty Font
            Name          = "Tahoma"
            Size          = 9,75
            Charset       = 178
            Weight        = 700
            Underline     = 0              'False
            Italic        = 0              'False
            Strikethrough = 0              'False
        EndProperty
        Picture = FCategorie.frx:0000
        Style = 1
    End
    Begin VB.CommandButton Command1
        Left   = 600
        Top    = 3240
        Width  = 1455
        Height = 615
        TabIndex = 7
        Picture = FCategorie.frx:0456
        Style = 1
    End
    Begin VB.Frame Frame2
        Caption = "C?????"
        ForeColor = 192
        Left   = 1800
        Top    = 1080
        Width  = 2775
        Height = 1185
        TabIndex = 6
        RightToLeft = -1              'True
        Begin VB.Frame Frame6
            Caption = "U?? ????"
            ForeColor = 32768
            Left   = 1440
            Top    = 240
            Width  = 1215
            Height = 825
            TabIndex = 17
            RightToLeft = -1              'True
            Begin Di6InputBox.InputBox Text4
                Left   = 120
                Top    = 240
                Width  = 975
                Height = 495
                TabIndex = 18
                OleObjectBlob = FCategorie.frx:0D34
                DataField = "MontMet"
            End
        End
        Begin VB.Frame Frame4
            Caption = "????"
            ForeColor = 32768
            Left   = 120
            Top    = 240
            Width  = 1215
            Height = 825
            TabIndex = 9
            RightToLeft = -1              'True
            Begin Di6InputBox.InputBox Text6
                Left   = 120
                Top    = 240
                Width  = 975
                Height = 495
                TabIndex = 12
                OleObjectBlob = FCategorie.frx:0D34
                DataField = "MontMetClo"
            End
        End
    End
    Begin VB.CommandButton Command8
        Left   = 1680
        Top    = 4200
        Width  = 375
        Height = 375
        TabIndex = 5
        Picture = FCategorie.frx:0D34
        Style = 1
    End
    Begin VB.CommandButton Command9
        Left   = 1320
        Top    = 4200
        Width  = 375
        Height = 375
        TabIndex = 4
        Picture = FCategorie.frx:111A
        Style = 1
    End
    Begin VB.CommandButton Command10
        Left   = 960
        Top    = 4200
        Width  = 375
        Height = 375
        TabIndex = 3
        Picture = FCategorie.frx:14B4
        Style = 1
    End
    Begin VB.CommandButton Command11
        Left   = 600
        Top    = 4200
        Width  = 375
        Height = 375
        TabIndex = 2
        Picture = FCategorie.frx:18A6
        Style = 1
    End
    Begin VB.Frame Frame3
        Caption = "C????"
        ForeColor = 12583104
        Left   = 240
        Top    = 240
        Width  = 4335
        Height = 780
        TabIndex = 0
        RightToLeft = -1              'True
        Begin VB.TextBox Text1
            Left   = 120
            Top    = 240
            Width  = 4095
            Height = 405
            TabIndex = 1
            Alignment = 1
            MaxLength = 50
            DataField = "LibCat"
            BeginProperty Font
                Name          = "MS Sans Serif"
                Size          = 12
                Charset       = 178
                Weight        = 400
                Underline     = 0              'False
                Italic        = 0              'False
                Strikethrough = 0              'False
            EndProperty
            RightToLeft = -1              'True
        End
    End
End
