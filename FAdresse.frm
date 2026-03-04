VERSION 5.00

Begin VB.Form FAdresse
    Caption = "C????C?"
    ScaleMode = 1
    AutoRedraw = 0              'False
    FontTransparent = -1              'True
    BorderStyle = 1
    LinkTopic = "Form1"
    MaxButton = 0              'False
    MinButton = 0              'False
    ClientLeft   = 45
    ClientTop    = 330
    ClientWidth  = 7920
    ClientHeight = 2490
    RightToLeft = -1              'True
    StartupPosition = 2
    Begin VB.CommandButton Command2
        Left   = 120
        Top    = 1200
        Width  = 1455
        Height = 615
        TabIndex = 9
        BeginProperty Font
            Name          = "Tahoma"
            Size          = 9,75
            Charset       = 178
            Weight        = 700
            Underline     = 0              'False
            Italic        = 0              'False
            Strikethrough = 0              'False
        EndProperty
        Picture = FAdresse.frx:0000
        Style = 1
    End
    Begin VB.CommandButton Command11
        Left   = 120
        Top    = 1320
        Width  = 375
        Height = 375
        TabIndex = 8
        Picture = FAdresse.frx:0456
        Style = 1
    End
    Begin VB.CommandButton Command10
        Left   = 480
        Top    = 1320
        Width  = 375
        Height = 375
        TabIndex = 7
        Picture = FAdresse.frx:083C
        Style = 1
    End
    Begin VB.CommandButton Command9
        Left   = 840
        Top    = 1320
        Width  = 375
        Height = 375
        TabIndex = 6
        Picture = FAdresse.frx:0C2E
        Style = 1
    End
    Begin VB.CommandButton Command8
        Left   = 1200
        Top    = 1320
        Width  = 375
        Height = 375
        TabIndex = 5
        Picture = FAdresse.frx:0FC8
        Style = 1
    End
    Begin VB.CommandButton Command1
        Left   = 120
        Top    = 360
        Width  = 1455
        Height = 615
        TabIndex = 4
        Picture = FAdresse.frx:13AE
        Style = 1
    End
    Begin VB.Frame Frame2
        Caption = "C????"
        ForeColor = 12583104
        Left   = 3960
        Top    = 120
        Width  = 1815
        Height = 900
        TabIndex = 2
        RightToLeft = -1              'True
        Begin VB.TextBox Text2
            ForeColor = 192
            Left   = 120
            Top    = 240
            Width  = 1575
            Height = 525
            TabIndex = 3
            Alignment = 2
            DataField = "CodeAdr"
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
        End
    End
    Begin VB.Frame Frame1
        Caption = "C????C?"
        ForeColor = 12583104
        Left   = 1800
        Top    = 1200
        Width  = 5895
        Height = 900
        TabIndex = 0
        RightToLeft = -1              'True
        Begin VB.TextBox Text1
            ForeColor = 12582912
            Left   = 120
            Top    = 240
            Width  = 5655
            Height = 525
            TabIndex = 1
            Alignment = 1
            MaxLength = 50
            DataField = "LibAdr"
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
End
